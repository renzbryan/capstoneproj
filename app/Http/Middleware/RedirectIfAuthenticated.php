<?php

namespace App\Http\Middleware;

use App\Models\User; 
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                if ($user->role === 'admin') {
                    return redirect()->route('admin.index');
                } elseif ($user->role === 'user') {
                    return redirect()->route('homepage.index');
                }

                // Default redirection if no specific role matched
                return redirect('/');
            }
        }

        return $next($request);
    }
    
}
