<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerGig extends Model
{
    protected $fillable = [
        'worker_id',
        'service_id',
        'title',
        'description',
        'tags',
        'budget',
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

    //customerBids
    public function customerBids(){
        return $this->hasMany(CustomerBid::class,'worker_gig_id','id');
    }
}
