<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'worker_id',
        'title',
        'description',
        'address',
        'service_id',
        'day',
        'budget',
        'status',
    ];

    //Customer
    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }

    //Worker
    public function worker(){
        return $this->belongsTo(User::class,'worker_id','id');
    }

    //cancelInfo
    public function cancelInfo(){
        return $this->hasOne(CancelJob::class,'job_id','id')->where('type', 'bid');
    }

    //Bid
    public function bids(){
        return $this->hasMany(Bid::class,'job_id','id');
    }
}
