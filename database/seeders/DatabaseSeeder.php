<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Bundle;
use App\Models\BundleRequirement;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Inquiry;
use App\Models\BusinessInfo;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================
        // USERS
        // ============================
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Lorenz Ciocon',
            'username' => 'lorenz',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Mia Chua',
            'username' => 'mia',
            'password' => Hash::make('password123456'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Erika Jaud',
            'username' => 'erika',
            'password' => Hash::make('password123456'),
            'role' => 'user',
        ]);

        // ============================
        // CATEGORIES
        // ============================
        $categories = [
            'Noodles/Pasta',
            'Dessert',
            'Salad',
            'Rice',
            'Beef',
            'Seafood',
            'Soup',
            'Chicken',
            'Pork'
        ];

        $categoryMap = [];

        foreach ($categories as $cat) {
            $category = Category::create(['name' => $cat]);
            $categoryMap[$cat] = $category->id;
        }

        // ============================
        // MENU ITEMS (2 PER CATEGORY)
        // ============================
        foreach ($categoryMap as $name => $id) {
            MenuItem::create([
                'name' => "$name Special A",
                'description' => 'Sample description',
                'price' => rand(400, 1500),
                'category_id' => $id,
                'is_active' => true
            ]);

            MenuItem::create([
                'name' => "$name Special B",
                'description' => 'Sample description',
                'price' => rand(400, 1500),
                'category_id' => $id,
                'is_active' => true
            ]);
        }

        // ============================
        // BUNDLES (3 TOTAL)
        // ============================
        $bundle1 = Bundle::create([
            'name' => 'Classic Wedding Reception',
            'description' => 'Standard full-course meal',
            'price_per_head' => 600
        ]);

        $bundle2 = Bundle::create([
            'name' => 'Premium Celebration Package',
            'description' => 'More premium dishes + seafood',
            'price_per_head' => 850
        ]);

        $bundle3 = Bundle::create([
            'name' => 'Budget Party Package',
            'description' => 'Simple but complete meal set',
            'price_per_head' => 450
        ]);

        // ============================
        // BUNDLE REQUIREMENTS
        // ============================

        // Classic
        foreach (['Rice','Noodles/Pasta','Beef','Chicken','Salad','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundle1->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // Premium (more items)
        foreach (['Rice','Seafood','Beef','Chicken','Soup','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundle2->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // Budget
        foreach (['Rice','Chicken','Pork','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundle3->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // ============================
        // BOOKINGS (MIXED)
        // ============================
        $users = User::where('role', 'user')->get();
        $menuItems = MenuItem::all();

        foreach ($users as $user) {

            // BUNDLE BOOKING
            $bundleBooking = Booking::create([
                'user_id' => $user->id,
                'event_type' => 'Wedding Reception',
                'event_date' => Carbon::now()->addDays(rand(1, 20)),
                'venue' => 'Hall A',
                'guest_count' => rand(20, 100),
                'status' => 'pending',
                'bundle_id' => $bundle1->id,
                'total_price' => 0, // optional
            ]);

            // attach random items (simulate bundle selections)
            $items = $menuItems->random(5);
            foreach ($items as $item) {
                BookingItem::create([
                    'booking_id' => $bundleBooking->id,
                    'menu_item_id' => $item->id,
                    'quantity' => 1,
                    'price' => $item->price,
                ]);
            }

            // CUSTOM BOOKING (NO BUNDLE)
            $customBooking = Booking::create([
                'user_id' => $user->id,
                'event_type' => 'Birthday Party',
                'event_date' => Carbon::now()->addDays(rand(5, 25)),
                'venue' => 'Garden',
                'guest_count' => rand(10, 50),
                'status' => 'confirmed',
                'bundle_id' => null,
                'total_price' => 0,
            ]);

            $items = $menuItems->random(3);
            foreach ($items as $item) {
                BookingItem::create([
                    'booking_id' => $customBooking->id,
                    'menu_item_id' => $item->id,
                    'quantity' => rand(1, 3),
                    'price' => $item->price,
                ]);
            }

            // INQUIRY
            Inquiry::create([
                'booking_id' => $bundleBooking->id,
                'sender_id' => $user->id,
                'message' => 'Can we change one dish?',
                'status' => 'new',
            ]);

        }

        //BUSINESS INFO
            BusinessInfo::create([
                'company_name' => 'BiteBook',
                'contact_person' => 'Mike Wilson',
                'company_email' => 'bitebook@gmail.com',
                'company_contact_number' => '09123456789',
                'location' => 'La Salle Avenue, Bacolod City',
            ]);  
    }
}