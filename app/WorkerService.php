<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
    ];

    //Category
    public function category(){
        return $this->belongsTo(WorkerServiceCategory::class,'category_id','id');
    }

    //Worker Service
    public function worker(){
        return $this->hasMany(WorkerAndService::class,'service_id','id');
    }

    //Gigs
    public function workerGigs(){
        return $this->hasMany(WorkerGig::class,'service_id','id')->orderBy('id','desc');
    }

    //customerGigs
    public function customerGigs(){
        return $this->hasMany(CustomerGig::class,'service_id','id');
    }
}
