<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GigOrder extends Model
{
    protected $fillable = [
        'gig_id',
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

    //Gig
    public function gig(){
        return $this->belongsTo(Gig::class,'gig_id','id');
    }

    //cancelInfo
    public function cancelInfo(){
        return $this->hasOne(CancelJob::class,'job_id','id')->where('type', 'gig');
    }
}
