<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes,LogsActivity;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
    public function bills()
    {
        return $this->morphMany('App\Models\Bill','model');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'client_user','user_id','client_id');
    }
    public function scopeCheck($query)
    {
        if (\Auth::user()->type != 'admin') {

            return $query->where('sales_man_id', \Auth::id());
        }
    }

}
