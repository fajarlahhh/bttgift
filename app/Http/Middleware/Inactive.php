<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Inactive
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
        if (auth()->user()->actived_at) {
            return abort(403, "Unauthorized Access");
        }
        return $next($request);
    }
}
