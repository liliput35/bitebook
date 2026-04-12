<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;  
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Bundle;
use App\Models\Inquiry;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Revenue
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // Recent Bookings
        $recentBookings = Booking::latest()->take(5)->get();

        // New Inquiries
        $newInquiries = Inquiry::where('status', 'new')->count();

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
        ->latest() // newest first (based on created_at)
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
        $bundles  = Bundle::all();
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

            return view('admin.booking_show', compact('booking'));
        }

    public function profile()
    {
        return view('admin.profile');
    }
}