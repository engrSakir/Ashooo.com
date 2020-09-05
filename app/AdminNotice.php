<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotice extends Model
{
    protected $fillable = [
        'admin_id',
        'title',
        'detail',
    ];

    //Admin
    public function admin(){
        return $this->belongsTo(User::class,'admin_id','id');
    }

}
