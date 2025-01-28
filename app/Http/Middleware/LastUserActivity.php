<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;
use App\User;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user_is_online_' . Auth::id(), true, $expiresAt);
            
            $user = User::find(Auth::id());
            $user->activity = Carbon::now('UTC');
            $user->save();
        }
        return $next($request);
    }
}