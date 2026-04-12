<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;  
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Bundle;
use App\Models\Inquiry;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }
    
    
    public function menu()
    {
        $menuItems  = MenuItem::with('category')->get();
        $totalMenuItems = MenuItem::all()->count() ;
        $categories = Category::all();
        return view('user.menu', compact('totalMenuItems','menuItems', 'categories'));
    } 

    public function itemDetails(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('user.menu_item', compact('menuItem', 'categories'));
    }

    public function cart()
    {
        $cart = session('cart', []);

        $menuItems = MenuItem::whereIn('id', array_keys($cart))->get();

        return view('user.cart', compact('cart', 'menuItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // BLOCK if bundle already selected
        if (session()->has('bundle_id')) {
            return back()->with('error', 'You already selected a bundle.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Added to selection!');
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated');
    } 

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item removed');
    }
    

    public function bundles()
    {
        $bundles  = Bundle::all();
        return view('user.bundles', compact('bundles'));
    }
    
    public function bundleDetails(Bundle $bundle)
    {
        return view('user.bundle_info', compact('bundle'));
    }

    public function selectBundle(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Prevent if cart has items
        if (session()->has('cart') && count(session('cart')) > 0) {
            return back()->with('error', 'You already selected menu items. Clear cart first.');
        }

        // Store bundle WITH quantity
        session()->put('bundle', [
            'id' => $id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('user.book')->with('success', 'Bundle selected!');
    }

    public function updateBundle(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $bundle = session('bundle');

        if ($bundle) {
            $bundle['quantity'] = $request->quantity;
            session()->put('bundle', $bundle);
        }

        return back()->with('success', 'Bundle updated');
    }

    public function removeBundle()
    {
        session()->forget('bundle');

        return back()->with('success', 'Bundle removed');
    }

    public function book()
    {
        $cart = session('cart', []);
        $bundleData = session('bundle');

        $menuItems = [];
        $total = 0;
        $bundle = null;

        if ($cart) {
            $menuItems = MenuItem::whereIn('id', array_keys($cart))->get();

            foreach ($menuItems as $item) {
                $qty = $cart[$item->id]['quantity'];
                $total += $item->price * $qty;
            }
        }

        if ($bundleData) {
            $bundle = Bundle::find($bundleData['id']);
            $total = $bundle->price_per_head * $bundleData['quantity'];
        }

        return view('user.book', compact('menuItems', 'cart', 'total', 'bundle', 'bundleData'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'event_type' => 'required',
            'event_date' => 'required|date',
            'guest_count' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        $bundleId = session('bundle_id');

        $total = 0;

        // CASE 1: BUNDLE
        if ($bundleId) {
            $bundle = Bundle::findOrFail($bundleId);
            $total = $bundle->price_per_head * $request->guest_count;
        }

        // CASE 2: CUSTOM MENU
        else {
            $menuItems = MenuItem::whereIn('id', array_keys($cart))->get();

            foreach ($menuItems as $item) {
                $qty = $cart[$item->id]['quantity'];
                $total += $item->price * $qty;
            }
        }

        // CREATE BOOKING
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'bundle_id' => $bundleId,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'guest_count' => $request->guest_count,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        // SAVE ITEMS IF CUSTOM
        if (!$bundleId) {
            foreach ($cart as $menuItemId => $details) {
                $menuItem = MenuItem::find($menuItemId);

                BookingItem::create([
                    'booking_id' => $booking->id,
                    'menu_item_id' => $menuItemId,
                    'quantity' => $details['quantity'],
                    'price' => $menuItem->price,
                ]);
            }
        }


        // CLEAR SESSION
        session()->forget('cart');
        session()->forget('bundle_id');

        return redirect()->route('user.home')->with('success', 'Booking created!');
    }

    //PROFILE
    public function profile()
    {
        return view('user.profile');
    }

}
