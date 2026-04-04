<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        ])->count();

        /* Most Popular Item (based on booking_items)
        $mostPopularItem = \DB::table('booking_items')
            ->select('menu_item_id', \DB::raw('SUM(quantity) as total'))
            ->groupBy('menu_item_id')
            ->orderByDesc('total')
            ->first();

        $popularItemName = null;

        if ($mostPopularItem) {
            $item = MenuItem::find($mostPopularItem->menu_item_id);
            $popularItemName = $item ? $item->name : null;
        } */

        // Admin dashboard
        if ($user->role === 'admin') {
            return view('admin.dashboard', compact(
                'totalRevenue',
                'recentBookings',
                'newInquiries',
                'upcomingBookings',
                'bookingsThisWeek'
            ));
        }

        // User dashboard
        return view('user.dashboard');

    }
}