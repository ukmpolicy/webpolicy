<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "id", "profile_picture", "name", "name", "nim", "address", "birth_place", "born_at", "phone_number", "email", "major", "interested_in", "study_program", "joined_at", "status", "store_document", "created_at", "updated_at"
    ];
}
