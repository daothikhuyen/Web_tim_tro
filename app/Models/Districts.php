<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "name_en",
        "full_name",
        "full_name_en",
        "code_name",
        "province_id",
        "administrative_unit_id"
    ];

    public function province()
    {
        return $this->hasOne(Provinces::class,'id','province_id');
    }
}
