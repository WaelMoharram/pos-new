<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Store extends Model
{

    protected $table = 'stores';
    public $timestamps = true;

    use SoftDeletes,LogsActivity;

    protected $dates = ['deleted_at'];
    protected $id = array('id');
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }

    public function Bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    public function salesMan()
    {
        return $this->hasOne('App\Models\User','sales_man_id');
    }


}
