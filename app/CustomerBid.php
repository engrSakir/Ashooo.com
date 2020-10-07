<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerBid extends Model
{
    protected $fillable = [
        'worker_gig_id',
        'customer_id',
        'status',
        'budget',
        'description',
        'address',
    ];

    //Customer
    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }

    //workerGig
    public function workerGig(){
        return $this->belongsTo(WorkerGig::class,'worker_gig_id','id');
    }

    //cancelInfo
    public function cancelInfo(){
        return $this->hasOne(CancelJob::class,'job_id','id')->where('type', 'customer-bid');
    }
}
