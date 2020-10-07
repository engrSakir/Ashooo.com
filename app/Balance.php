<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'due',
    ];

    //user
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
