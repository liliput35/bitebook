<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;  
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Bundle;
use App\Models\Inquiry;
use App\Models\BookingItem;
use App\Models\BusinessInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Revenue
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // Recent Bookings
        $recentBookings = Booking::latest()->take(5)->get();

        // New Inquiries
        $newInquiries = Inquiry::whereNull('parent_id')
            ->where('status', 'new')
            ->count();

        // Upcoming Bookings
        $upcomingBookings = Booking::whereDate('event_date', '>=', Carbon::now())->count();

        // Bookings This Week
        $bookingsThisWeek = Booking::whereBetween('event_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])
        ->orderBy('event_date', 'asc') // upcoming first
        ->take(3)
        ->get(); 

        //DEBUG PURPOSES
        //$bookingsThisWeek = Booking::all();

        /* Most Popular Item (based on booking_items) */
        $mostPopular = DB::table('booking_items')
            ->select('menu_item_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('menu_item_id')
            ->orderByDesc('total_quantity')
            ->first();

        $mostPopularItem = null;

        if ($mostPopular) {
            $mostPopularItem = \App\Models\MenuItem::find($mostPopular->menu_item_id);
        } 

        //RECENT INQUIRIES 
        $recentInquiries = Inquiry::with(['booking', 'sender'])
            ->whereNull('parent_id') // 👈 THIS LINE FIXES IT
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'recentBookings',
            'newInquiries',
            'upcomingBookings',
            'bookingsThisWeek', 
            'mostPopularItem', 
            'recentInquiries' 
        ));
    }

    public function menu()
    {
        $menuItems  = MenuItem::with('category')->get();
        $totalMenuItems = MenuItem::all()->count() ;
        $categories = Category::all();
        return view('admin.menu', compact('totalMenuItems','menuItems', 'categories'));
    }

    public function bundles()
    {
        $bundles  = Bundle::all();
        $totalBundles = Bundle::all()->count() ;
        return view('admin.bundles', compact('bundles', 'totalBundles'));
    }

    public function management()
    {
        $totalMenuItems = MenuItem::all()->count() ;
        $menuItems  = MenuItem::with('category')->take(4)->get();
        $categories = Category::all();
        $bundles  = Bundle::all()->take(4);
        $totalBundles = Bundle::all()->count() ;
        return view('admin.management', compact('totalMenuItems', 'menuItems', 'categories', 'bundles', 'totalBundles'));
    }

    public function inquiries($id = null)
    {
        $allInquiries = Inquiry::with('sender')
        ->whereNull('parent_id') // only main inquiries
        ->latest()
        ->get();

        $selectedInquiry = null;

        if ($id) {
            $selectedInquiry = Inquiry::with(['sender', 'replies.sender', 'booking'])
                ->findOrFail($id);
        }

        return view('admin.inquiries', compact('allInquiries', 'selectedInquiry'));
    } 

    public function bookings()
    {
        $bookings = Booking::with('user')
            ->orderBy('event_date', 'asc')
            ->get()
            ->groupBy(function ($booking) {
                return Carbon::parse($booking->event_date)->toDateString(); // YYYY-MM-DD
            })
            ->mapWithKeys(function ($group, $date) {
                return [
                    Carbon::parse($date)->format('l, F j') => $group
                ];
            });

        return view('admin.bookings', compact('bookings'));
    }

    public function showBooking(Booking $booking)
    {
        $booking->load(['user', 'bundle', 'items']); // load relationships

       $subtotal = 0;

        foreach ($booking->items as $item) {
            $subtotal += $item->price * $item->quantity;
        }

        $bundleTotal = null;

        if ($booking->bundle) {
            $bundleTotal = $booking->bundle->price_per_head * $booking->guest_count;
        }

        $delivSetup = 0 ;
        if($booking->total_price > 0 && $booking->bundle){
            $delivSetup = $booking->total_price - $bundleTotal ;
        } else if($booking->total_price > 0 && !$booking->bundle){ 
            $delivSetup = $booking->total_price - $subtotal ;
        }

        return view('admin.booking_show', compact(
            'booking',
            'subtotal',
            'bundleTotal',
            'delivSetup'
        ));
    }

    //PROFILE
    public function profile()
    {
        $business = BusinessInfo::first();

        return view('admin.profile', compact('business'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable|string',
            'username' => 'required|unique:users,username,' . auth()->id(),
            'password' => 'nullable|min:6',

            //BUSINESS FIELDS
            'company_name' => 'required',
            'contact_person' => 'required',
            'company_email' => 'required|email',
            'company_contact_number' => 'required',
            'location' => 'required',
        ]);

        $user = auth()->user();

        // combine name safely
        $user->name = trim(
            $request->first_name . 
            ($request->last_name ? ' ' . $request->last_name : '')
        );
        $user->username = trim($request->username);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Auth::login($user);

        $business = BusinessInfo::first();

        if (!$business) {
            $business = BusinessInfo::create([]);
        }

        $business->update([
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'company_email' => $request->company_email,
            'company_contact_number' => $request->company_contact_number,
            'location' => $request->location,
        ]);
        
        return back()->with('success', 'Profile updated successfully!');
    }

    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        // Close related inquiries
        Inquiry::where('booking_id', $id)
            ->whereNull('parent_id')
            ->update(['status' => 'confirmed']);

        return redirect()->route('admin.bookings')
    ->with('success', 'Booking confirmed');
    }

    public function editBooking(Booking $booking)
    {
        $booking->load('items.menuItem', 'bundle.requirements.category.menuItems');

        $menuItems = MenuItem::all();

        $bundle = $booking->bundle;

        $existingSelections = [];

        if ($bundle) {
            foreach ($booking->items as $item) {
                $categoryId = $item->menuItem->category_id;

                $existingSelections[$categoryId][] = $item->menu_item_id;
            }
        }

        return view('admin.edit_booking', compact(
            'booking',
            'menuItems',
            'bundle',
            'existingSelections'
        ));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        // 1. UPDATE BOOKING DETAILS
        $booking->update([
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'guest_count' => $request->guest_count,
            'venue' => $request->venue,
        ]);

        // =========================
        // CASE 1: BUNDLE BOOKING
        // =========================
        if ($booking->bundle) {

            $bundle = Bundle::with('requirements.category')
            ->findOrFail($booking->bundle_id);

            // VALIDATE (same as user)
            foreach ($bundle->requirements as $req) {
                $selected = $request->selections[$req->category_id] ?? [];

                if (count($selected) != $req->required_quantity) {
                    return back()->with('error',
                        "Select exactly {$req->required_quantity} items for {$req->category->name}");
                }
            }

            // DELETE OLD ITEMS
            $booking->items()->delete();

            // RECREATE ITEMS
            foreach ($request->selections as $items) {
                foreach ($items as $itemId) {

                    $menuItem = MenuItem::find($itemId);

                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'menu_item_id' => $itemId,
                        'quantity' => 1,
                        'price' => $menuItem->price,
                    ]);
                }
            }

            // RECALC using updated guest_count
            $guestCount = $request->guest_count;
            $bundleTotal = $bundle->price_per_head * $guestCount;

            if ($guestCount <= 50) {
                $delivSetup = 500;
            } elseif ($guestCount <= 100) {
                $delivSetup = 800;
            } else {
                $delivSetup = 1200;
            }

            $booking->update([
                'total_price' => $bundleTotal + $delivSetup,
            ]);

            return redirect()->route('admin.bookings.show', $booking->id)
                ->with('success', 'Bundle updated successfully');
        }

        // =========================
        // CASE 2: CUSTOM MENU
        // =========================
        $existingIds = [];

        if ($request->existing_items) {
            foreach ($request->existing_items as $itemId => $data) {

                if (isset($data['delete'])) {
                    BookingItem::where('id', $itemId)->delete();
                    continue;
                }

                $item = BookingItem::find($itemId);

                if ($item) {
                    $item->update([
                        'quantity' => $data['quantity']
                    ]);

                    $existingIds[] = $itemId;
                }
            }
        }

        // 3. ADD NEW ITEMS
        if ($request->new_items) {
            foreach ($request->new_items as $newItem) {

                if (!empty($newItem['menu_item_id']) && !empty($newItem['quantity'])) {

                    $menuItem = MenuItem::find($newItem['menu_item_id']);

                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'menu_item_id' => $menuItem->id,
                        'quantity' => $newItem['quantity'],
                        'price' => $menuItem->price,
                    ]);
                }
            }
        }

        // RECALC subtotal and totalQty fresh from DB after all edits
        $booking->load('items');

        $subtotal = 0;
        $totalQty = 0;

        foreach ($booking->items as $item) {
            $subtotal += $item->price * $item->quantity;
            $totalQty += $item->quantity;
        }

        if ($totalQty <= 20) {
            $delivSetup = 200;
        } elseif ($totalQty <= 50) {
            $delivSetup = 350;
        } else {
            $delivSetup = 500;
        }

        $booking->update([
            'total_price' => $subtotal + $delivSetup,
        ]);

        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Booking updated successfully');
    } 

    public function createBooking()
    {
        $menuItems = MenuItem::all();
        $bundles = Bundle::with('requirements.category.menuItems')->get();

        return view('admin.create_booking', compact('menuItems', 'bundles'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'event_type' => 'required',
            'event_date' => 'required|date',
            'guest_count' => 'required|integer|min:1',
            'venue' => 'required|string|max:255',
        ]);

        $total = 0;
        $delivSetup = 0;


        // =========================
        // CASE 1: BUNDLE
        // =========================
        if ($request->bundle_id) {

            $bundle = Bundle::with('requirements.category')
                ->findOrFail($request->bundle_id);

            // VALIDATE (same as user/admin edit)
            foreach ($bundle->requirements as $req) {
                $selected = $request->selections[$req->category_id] ?? [];

                if (count($selected) != $req->required_quantity) {
                    return back()->with('error',
                        "Select exactly {$req->required_quantity} items for {$req->category->name}");
                }
            }

            $total = $bundle->price_per_head * $request->guest_count;
            if ($bundle) {
                $guestCount = $request->guest_count;

                if ($guestCount <= 50) {
                    $delivSetup = 500;
                } elseif ($guestCount <= 100) {
                    $delivSetup = 800;
                } else {
                    $delivSetup = 1200;
                }
            } 

            $booking = Booking::create([
                'user_id' => null, // or assign later
                'bundle_id' => $bundle->id,
                'event_type' => $request->event_type,
                'venue' => $request->venue,
                'event_date' => $request->event_date,
                'guest_count' => $request->guest_count,
                'status' => 'pending',
                'total_price' => $total + $delivSetup,
            ]);

            foreach ($request->selections as $items) {
                foreach ($items as $itemId) {

                    $menuItem = MenuItem::find($itemId);

                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'menu_item_id' => $itemId,
                        'quantity' => 1,
                        'price' => $menuItem->price,
                    ]);
                }
            }
        }

        // =========================
        // CASE 2: CUSTOM MENU
        // =========================
        else {
            $totalQty = 0 ;
            foreach ($request->new_items as $item) {
                if (!empty($item['menu_item_id']) && !empty($item['quantity'])) {
                    $menuItem = MenuItem::find($item['menu_item_id']);
                    $total += $menuItem->price * $item['quantity'];
                    $totalQty += $item['quantity'] ;
                }
            }

            if ($totalQty <= 20) {
                $delivSetup = 200;
            } elseif ($totalQty <= 50) {
                $delivSetup = 350;
            } else {
                $delivSetup = 500;
            }

            $booking = Booking::create([
                'user_id' => 1,
                'bundle_id' => null,
                'event_type' => $request->event_type,
                'venue' => $request->venue,
                'event_date' => $request->event_date,
                'guest_count' => $request->guest_count,
                'status' => 'pending',
                'total_price' => $total + $delivSetup,
            ]);

            foreach ($request->new_items as $item) {

                if (!empty($item['menu_item_id']) && !empty($item['quantity'])) {

                    $menuItem = MenuItem::find($item['menu_item_id']);

                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'menu_item_id' => $menuItem->id,
                        'quantity' => $item['quantity'],
                        'price' => $menuItem->price,
                    ]);
                }
            }
        }

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking created successfully');
    }

}