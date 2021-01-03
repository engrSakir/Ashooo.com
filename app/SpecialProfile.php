<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialProfile extends Model
{
    protected $fillable = [
        'special_service_id',
        'controller_id',
        'upazila_id',
        'name',
        'phone',
        'image',
        'description'
        ];
}
