<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratting_Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        "feedback_id",
        "user_id",
        "like"
    ];
}
