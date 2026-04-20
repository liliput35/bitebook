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
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Erika Jaud',
            'username' => 'erika',
            'password' => Hash::make('123456'),
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
        // MENU ITEMS (CUSTOM)
        // ============================

        $menuItemsData = [
            ['name' => 'Roast Beef w/ Mashed Potatoes', 'cat' => 'Beef', 'price' => 1200, 'img' => 'roast-beef.png'],
            ['name' => 'Chicken Relleno', 'cat' => 'Chicken', 'price' => 950, 'img' => 'chicken-relleno.png'],
            ['name' => 'Paella', 'cat' => 'Rice', 'price' => 1550, 'img' => 'paella.png'],
            ['name' => 'Lasagna', 'cat' => 'Noodles/Pasta', 'price' => 1100, 'img' => 'lasagna.png'],
            ['name' => 'Waldorf Salad', 'cat' => 'Salad', 'price' => 650, 'img' => 'waldorf-salad.png'],
            ['name' => 'Carbonara', 'cat' => 'Noodles/Pasta', 'price' => 900, 'img' => 'carbonara.png'],
            ['name' => 'Chicken Alfredo', 'cat' => 'Noodles/Pasta', 'price' => 980, 'img' => 'chicken-alfredo.png'],
            ['name' => 'Yang Chow Rice', 'cat' => 'Rice', 'price' => 700, 'img' => 'yang-chow.png'],
        ];

        foreach ($menuItemsData as $item) {
            MenuItem::create([
                'name' => $item['name'],
                'description' => 'Sample description',
                'price' => $item['price'],
                'image' => 'menu/' . $item['img'], // IMPORTANT
                'category_id' => $categoryMap[$item['cat']],
                'is_active' => true
            ]);
        }

        // ============================
        // BUNDLES (8 TOTAL)
        // ============================

        $bundlesData = [
            ['name' => 'Classic Wedding Reception', 'price' => 600, 'img' => 'classic-wedding-reception.png'],
            ['name' => 'Grand Celebration', 'price' => 900, 'img' => 'grand-celebration.png'],
            ['name' => 'Family Reunion', 'price' => 550, 'img' => 'family-reunion.png'],
            ['name' => 'Anniversary Dinner', 'price' => 650, 'img' => 'anniversary-dinner.png'],
            ['name' => 'Debut Party', 'price' => 700, 'img' => 'debut-party.png'],
            ['name' => 'Packed Meal', 'price' => 250, 'img' => 'packed-meal.png'],
            ['name' => 'Funeral Reception', 'price' => 500, 'img' => 'funeral-reception.png'],
            ['name' => 'Team Building Feast', 'price' => 750, 'img' => 'team-building.png'],
        ];

        $bundleObjects = [];

        foreach ($bundlesData as $b) {
            $bundleObjects[$b['name']] = Bundle::create([
                'name' => $b['name'],
                'description' => 'Sample bundle description',
                'price_per_head' => $b['price'],
                'image' => 'bundles/' . $b['img'] // IMPORTANT
            ]);
        }

        // ============================
        // BUNDLE REQUIREMENTS
        // ============================

        // Classic Wedding
        foreach (['Rice','Noodles/Pasta','Beef','Chicken','Salad','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundleObjects['Classic Wedding Reception']->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // Grand Celebration
        foreach (['Rice','Seafood','Beef','Chicken','Soup','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundleObjects['Grand Celebration']->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // Family Reunion
        foreach (['Rice','Chicken','Pork','Dessert'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundleObjects['Family Reunion']->id,
                'category_id' => $categoryMap[$cat],
                'required_quantity' => 1
            ]);
        }

        // Reuse simple sets for others
        foreach (['Anniversary Dinner','Debut Party','Funeral Reception','Team Building Feast'] as $bundleName) {
            foreach (['Rice','Chicken','Dessert'] as $cat) {
                BundleRequirement::create([
                    'bundle_id' => $bundleObjects[$bundleName]->id,
                    'category_id' => $categoryMap[$cat],
                    'required_quantity' => 1
                ]);
            }
        }

        // Packed Meal (simple)
        foreach (['Rice','Chicken'] as $cat) {
            BundleRequirement::create([
                'bundle_id' => $bundleObjects['Packed Meal']->id,
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
                'bundle_id' => $bundleObjects['Classic Wedding Reception']->id,
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