<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerServiceCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    //Service
    public function service(){
        return $this->hasMany(WorkerService::class,'category_id','id')->orderBy('id','desc');
    }
}
