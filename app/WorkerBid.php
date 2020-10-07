<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerBid extends Model
{
    protected $fillable = [
        'customer_gig_id',
        'worker_id',
        'budget',
        'description',
        'is_selected',
        'is_cancelled',
    ];

    //Job
    public function customerGig(){
        return $this->belongsTo(CustomerGig::class,'customer_gig_id','id');
    }

    //Worker
    public function worker(){
        return $this->belongsTo(User::class,'worker_id','id');
    }
}
