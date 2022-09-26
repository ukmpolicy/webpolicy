<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SetupController;
use Closure;
use Illuminate\Http\Request;

class SetupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (SetupController::hasSetup()) {
            return $next($request);
        }else {
            SetupController::setup($request, $next);
        }
    }
}
