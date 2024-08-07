<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratting_Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "post_id",
        "like"
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
