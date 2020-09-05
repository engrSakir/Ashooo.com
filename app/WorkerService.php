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
}
