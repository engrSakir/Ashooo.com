<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipServiceCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    //Service
    public function service(){
        return $this->hasMany(MembershipService::class,'category_id','id')->orderBy('id','desc');
    }
}
