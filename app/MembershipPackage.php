<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    protected $fillable = [
        'name',
        'three_month_price',
        'six_month_price',
        'twelve_month_price',
        'mobile_availability',
        'description_availability',
        'image_count',
        'position',
    ];

    //Membership Type User
    public function membership(){
        return $this->hasMany(Membership::class,'package_id','id');
    }
}
