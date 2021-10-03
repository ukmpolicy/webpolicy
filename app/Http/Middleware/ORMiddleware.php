<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ORMiddleware
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
        $today = (int) date('d');
        $open = false;
        if (($today >= 4 && $today < 15) || $open) {
            return $next($request);
        }
        return redirect()->route('open-recruitment');
    }
}
