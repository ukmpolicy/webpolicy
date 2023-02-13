<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'period_id', 'division_id', 'index', 'sub_in_position_id'
    ];

    public static function getLastIndex() {
        $positions = Position::where('sub_in_position_id', null)->get();
        $index = 1;
        foreach ($positions as $position) {
            if ($position->index >= $index) {
                $index++;
            }
        }
        return $index;
    }

    public static function getLastIndexInDivision($division_id) {
        $positions = Position::where('division_id', $division_id)->get();
        $index = 1;
        foreach ($positions as $position) {
            if ($position->sub_in_position_id != null) {
                if ($position->index >= $index) {
                    $index++;
                }
            }
        }
        return $index;
    }
}
