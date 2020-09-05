<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminAds extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'url',
        'image',
        'starting',
        'ending',
        'status',
    ];

    //Admin
    public function admin(){
        return $this->belongsTo(User::class,'admin_id','id');
    }
}
