<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        "form_id", "question", "description", "type"
    ];
}
