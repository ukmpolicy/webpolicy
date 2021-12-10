<?php

namespace App\Http\Middleware;

use App\Models\Setting;
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

        $settings = [];
        foreach (Setting::all() as $s) {
            $settings[$s->key] = $s->value;
        }
        $start = strtotime($settings['or_setting_start']);
        $end = strtotime($settings['or_setting_end']);
        $status = $settings['or_setting_status'];
        $open = false;
        if ($status == 0) {
            $open = (time() >= $start && time() <= $end);
        }elseif ($status == 1) {
            $open = true;
        }elseif ($status == 2){
            $open = false;
        }
        if ($open) {
            return $next($request);
        }
        return redirect()->route('open-recruitment');
    }
}
