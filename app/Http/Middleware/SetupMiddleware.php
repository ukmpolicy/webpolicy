<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SetupController;
use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

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
        // Visit::create([
        //     'url' => $request->url(),
        //     'route_name' => $request->route()->getName()
        // ]);
        if (SetupController::hasSetup()) {
            return $next($request);
        }else {
            SetupController::setup($request, $next);
        }
    }
}
