<?php

namespace Modules\Supplier\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class supplierMiddleware
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
        // if (!auth()->guard('supplier')->check()) {
            return $next($request);
        // }
        // return redirect()->route('supplier.dashboard');
    }
}
