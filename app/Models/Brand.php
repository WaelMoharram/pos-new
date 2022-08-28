<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Brand extends Model
{

    protected $table = 'brands';
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
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

}
