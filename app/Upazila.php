<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'district_id',
    ];

    //District
    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

    //User
    public function user(){
        return $this->hasMany(User::class,'upazila_id','id')->orderBy('id','desc');
    }
}
