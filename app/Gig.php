<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    protected $fillable = [
        'worker_id',
        'service_id',
        'title',
        'description',
        'tags',
        'price',
        'day',

    ];

    //Worker
    public function worker(){
        return $this->belongsTo(User::class,'worker_id','id');
    }

    //Service
    public function service(){
        return $this->belongsTo(WorkerService::class,'service_id','id');
    }

    //GigOrders
    public function gigOrders(){
        return $this->hasMany(GigOrder::class,'gig_id','id');
    }
}
