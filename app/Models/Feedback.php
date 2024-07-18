<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'parent_id',
        'is_deleted'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
