<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'image',
        'mobile',
        'type'
    ];

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
        return $this->hasOne('App\Models\Store','sales_man_id');
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

}
