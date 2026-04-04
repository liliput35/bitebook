<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\MenuItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

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

        // Admin dashboard
        if ($user->role === 'admin') {
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

        // User dashboard
        return view('user.dashboard');

    }
}