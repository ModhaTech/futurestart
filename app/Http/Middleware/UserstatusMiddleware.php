<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;

class UserstatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->status == 0))
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Session::flash('error', 'Your Account Block by Admin.Please Contact Admin.');

        }

        return $next($request);
    }
}
