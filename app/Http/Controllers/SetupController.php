<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Guest\OpenRecruitmentController;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public static function hasSetup() {
        return !is_null(Setting::where('key', 'app_setup')->first());
    }

    public static function setup(Request $request, $next) {
        Role::initRole();
        OpenRecruitmentController::initSettings();
        Setting::create([
            "key" => "app_setup",
            "value" => "true",
        ]);

        return $next($request);
    }
}
