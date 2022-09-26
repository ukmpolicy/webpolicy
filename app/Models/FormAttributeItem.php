<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttributeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "form_attribute_id", "name"
    ];
}
