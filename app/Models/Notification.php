<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function read() {
        $notification = Notification::find($this->id);
        $notification->readed_at = \Carbon\Carbon::now();
        $notification->save();
    }
}
