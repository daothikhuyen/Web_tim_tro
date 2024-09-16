<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "name_en",
        "full_name",
        "full_name_en",
        "code_name",
        "district_id",
        "administrative_unit_id"
    ];

    public function district()
    {
        return $this->hasOne(Districts::class,'id','district_id');
    }
}
