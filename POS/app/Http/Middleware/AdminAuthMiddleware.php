<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::user())){
                //if we go to register page or login page
            if(url()->current() == route('admin#loginPage') || url()->current() == route('admin#registerPage')){

                return back();

            }
            if(Auth::user()->role == 'user' ){

                return back();

            }

        }
        return $next($request);

    }
}
