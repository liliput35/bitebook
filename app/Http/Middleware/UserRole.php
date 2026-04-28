<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== 'user') {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
