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
use App\Models\Inquiry;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //USER admin 123456 
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        //USER Lorenz 123456 
        User::create([
            'name' => 'Lorenz Ciocon',
            'username' => 'lorenz',
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
        // MENU ITEMS
        // ============================
        MenuItem::create([
            'name' => 'Roast Beef w/ Mashed Potatoes',
            'description' => 'Sample description',
            'price' => 1200,
            'image' => null,
            'is_active' => true,
            'category_id' => $categoryMap['Beef']
        ]);

        MenuItem::create([
            'name' => 'Chicken Relleno',
            'description' => 'Sample description',
            'price' => 950,
            'image' => null,
            'is_active' => true,
            'category_id' => $categoryMap['Chicken']
        ]);

        MenuItem::create([
            'name' => 'Paella',
            'description' => 'Sample description',
            'price' => 1550,
            'image' => null,
            'is_active' => true,
            'category_id' => $categoryMap['Rice']
        ]);

        MenuItem::create([
            'name' => 'Lasagna',
            'description' => 'Sample description',
            'price' => 1100,
            'image' => null,
            'is_active' => true,
            'category_id' => $categoryMap['Noodles/Pasta']
        ]);

        // ============================
        // BUNDLE
        // ============================
        $bundle = Bundle::create([
            'name' => 'Classic Wedding Reception',
            'description' => 'Standard full-course meal (rice or pasta, two main dishes, salad, sides, dessert, drinks)',
            'price_per_head' => 600
        ]);

        // ============================
        // BUNDLE REQUIREMENTS
        // (Defines what categories user must choose from)
        // ============================
        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Rice'],
            'required_quantity' => 1
        ]);

        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Noodles/Pasta'],
            'required_quantity' => 1
        ]);

        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Beef'],
            'required_quantity' => 1
        ]);

        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Chicken'],
            'required_quantity' => 1
        ]);

        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Salad'],
            'required_quantity' => 1
        ]);

        BundleRequirement::create([
            'bundle_id' => $bundle->id,
            'category_id' => $categoryMap['Dessert'],
            'required_quantity' => 1
        ]);


        $user = User::offset(1)->first();

        //BOOKINGS
        Booking::create([
            'user_id' => $user->id,
            'event_date' => Carbon::now()->addDays(3),
            'guest_count' => 100,
            'status' => 'confirmed',
            'total_price' => 60000,
            'bundle_id' => 1,
        ]);

        Booking::create([
            'user_id' => $user->id,
            'event_date' => Carbon::now()->addDays(7),
            'guest_count' => 50,
            'status' => 'pending',
            'total_price' => 30000,
            'bundle_id' => 1,
        ]);

        Inquiry::create([
            'booking_id' => 1,
            'sender_id' => $user->id,
            'message' => 'Can we adjust the menu?',
            'status' => 'new',
        ]);
    }
}