<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions,HasRoles,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const GROUPS = [
        'users',
        'sales_men',
        'stores',
        'transfer',
        'categories',
        'brands',
//        'options',
        'items',
        'sales',
        'sales-return',
        'client',
        'purchases',
        'purchases-return',
        'suppliers',
        'payments',
        'settings',
        'reports',
    ];

    const SALES_GROUPS = [

        'stores',
        'sales',
        'sales-return',
        'client',
        'payments',

    ];

    public function acceptBills()
    {
        return $this->hasMany('App\Models\Bill', 'accept_user_id');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill', 'sales_man_id');
    }

    public function store()
    {
        if ($this->type == 'sales'){
            return $this->hasOne('App\Models\Store','sales_man_id');
        }
        return $this->belongsTo(Store::class,'store_id');
    }


    public function canBeAdmin(){
        if ($this->type == 'admin'){
            return true;
        }
        return false;
    }

    public function getForCollectAttribute()
    {
        $in =  $this->bills()->where('type','cash_in')->where('money_collected',0)->sum('money');

        $out = $this->bills()->where('type','cash_out')->where('money_collected',0)->sum('money');

        return $in - $out;
    }


    // get sales bills count filtred by from_date and to_date
    public function getSalesBillsCountAttribute()
    {
        if (request()->has('from_date') && request()->has('to_date')){
            $from_date = request()->get('from_date').' 00:00:00';
            $to_date = request()->get('to_date').' 23:59:59';
            return $this->bills()->where('type','sale_out')->whereBetween('created_at',[$from_date,$to_date])->count();
        }
        return $this->bills()->where('type','sale_out')->count();
    }

}
