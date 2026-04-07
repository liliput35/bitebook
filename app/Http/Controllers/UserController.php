<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\MenuItem;
use App\Models\Category;

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
    

    public function bundles()
    {
        
        return view('user.bundles');
    }

    public function book()
    {
        
        return view('user.book');
    }

}
