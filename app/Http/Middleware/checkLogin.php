<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if(Auth::check()) {
            // If authenticated, allow the request to proceed
            return $next($request);
        }
        // If not authenticated, redirect to the login page with an error message
        return redirect()->route('login')->with('error', 'Anda Harus Login dahulu!!!.');
    }
}
