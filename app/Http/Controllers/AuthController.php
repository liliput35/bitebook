<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    } 

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Role-based redirect
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'login' => 'Invalid credentials',
        ]);
    } 

    public function signup(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'username.unique' => 'Username is already taken.',
            'password.min' => 'Password must be at least 6 characters.',
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
        ]);

        $user = User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}