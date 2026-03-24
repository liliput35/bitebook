<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function menu()
    {
        return view('admin.menu');
    }

    public function inquiries()
    {
        return view('admin.inquiries');
    }
}