<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;  
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function menu()
    {
        $menuItems  = MenuItem::with('category')->get();
        $categories = Category::all();
        return view('admin.menu', compact('menuItems', 'categories'));
    }

    public function inquiries()
    {
        return view('admin.inquiries');
    }
}