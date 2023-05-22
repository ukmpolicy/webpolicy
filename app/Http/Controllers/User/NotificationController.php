<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $user = Auth::user()->id;
        $notifications = Notification::where('user_id', $user)->get();
        foreach (Notification::where('user_id', $user)->where('readed_at', '=', null) as $notif) {
            $notif->read();
        }
        return view('user.notifications.index', compact('notifications'));
    }
}
