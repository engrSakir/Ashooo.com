<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
    ];

    //Category
    public function category(){
        return $this->belongsTo(MembershipServiceCategory::class,'category_id','id');
    }
}
