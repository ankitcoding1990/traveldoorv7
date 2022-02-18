<?php

namespace App\Http\Middleware;

use Closure;

class isAdminActive
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
        if (auth()->user()->status == 0) {
          auth()->logout();
          return abort(403, 'User Account has been blocked');
        }
        return $next($request);
    }
}
