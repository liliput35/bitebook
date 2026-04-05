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

        if ($user->role !== 'user') {
            // Optionally redirect admin to their dashboard
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
