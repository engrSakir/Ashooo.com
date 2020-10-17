<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'user_name',
        'phone',
        'image',
        'gender',
        'upazila_id',
        'role',
        'phone_verified_at',
        'last_login_at',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    //Upazila
    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazila_id','id');
    }

    //Referral
    public function referral(){
        return $this->hasOne(Referral::class,'user_id','id');
    }

    //AdminNotice
    public function adminNotice(){
        return $this->hasMany(AdminNotice::class,'admin_id','id')
            ->orderBy('id', 'desc')
            ->take(1);  //For latest one taking
    }

    //ControllerNotice
    public function controllerNotice(){
        return $this->hasMany(ControllerNotice::class,'controller_id','id')
            ->orderBy('id', 'desc')
            ->take(1);  //For latest one taking
    }

    //AdminAds
    public function adminAds(){
        return $this->hasMany(AdminAds::class,'admin_id','id');
    }

    //ControllerAds
    public function controllerAds(){
        return $this->hasMany(ControllerAds::class,'controller_id','id');
    }

    //customerGigs
    public function customerGigs(){
        return $this->hasMany(CustomerGig::class,'customer_id','id');
    }

    //cancelInfo
    public function cancelInfo(){
        return $this->hasMany(CancelJob::class,'canceller_id','id');
    }

    //workerBids
    public function workerBids(){
        return $this->hasMany(WorkerBid::class,'worker_id','id');
    }

    //workerGigs
    public function workerGigs(){
        return $this->hasMany(WorkerGig::class,'worker_id','id');
    }

    //customerBids
    public function customerBids(){
        return $this->hasMany(CustomerBid::class,'customer_id','id');
    }

    //jobsOfCustomer
    public function jobsOfCustomer(){
        return $this->hasMany(Job::class,'customer_id','id');
    }

    //jobsOfWorker
    public function jobsOfWorker(){
        return $this->hasMany(Job::class,'worker_id','id');
    }

    //Nid
    public function nid(){
        return $this->hasOne(Nid::class,'user_id','id');
    }

    //Worker Service
    public function workerService(){
        return $this->hasMany(WorkerAndService::class,'worker_id','id');
    }

    //Membership Service
    public function membershipService(){
        return $this->hasMany(MembershipAndService::class,'membership_id','id');
    }

    //Membership
    public function membership(){
        return $this->hasOne(Membership::class,'user_id','id')->whereDate('ending_at', '>', \Carbon\Carbon::today()->addDays(-1))->orderBy('id', 'desc');
    }

    //Rating
    public function rating(){
        return $this->hasOne(Rating::class,'user_id','id');
    }

    //Balance
    public function balance(){
        return $this->hasOne(Balance::class,'user_id','id');
    }
}
