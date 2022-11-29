<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{

    protected $table = 'suppliers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logUnguarded();
//        // Chain fluent methods for configuration options
//    }
    public function bills()
    {
        return $this->morphMany(Bill::class,'model');
    }

}
