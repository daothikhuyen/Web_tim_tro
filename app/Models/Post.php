<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'area',
        'full_address',
        'user_id',
        'category_id',
        'province_id',
        'district_id',
        'ward_id',
        'street_id',
        'video_link',
        'number_like'
    ];
}
