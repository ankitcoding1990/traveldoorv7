<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class IsTravelUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (session()->has('travel_users_id')) {
        //   $user = User::where('users_id', session()->get('travel_users_id'))->first();
        //   return $next($request);
        // }
        // return redirect()->route('index');
        return $next($request);
    }


}
