<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'description', 'status',
    ];

    public static function getPeriodeActive() {
        return Period::where('status', 1)->first();
    }
}
