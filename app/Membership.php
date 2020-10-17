<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'membership_package_id',
        'duration',
        'ending_at',
    ];

    //Membership Type User
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //Membership Package
    public function membershipPackage(){
        return $this->belongsTo(MembershipPackage::class,'membership_package_id','id');
    }
}
