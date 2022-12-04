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

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logUnguarded();
//        // Chain fluent methods for configuration options
//    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    public function salesMan()
    {
        return $this->hasOne('App\Models\User','sales_man_id');
    }

    public function getSelectNameAttribute(){
        $type = '';
        if ($this->sales_man_id == null){
            $type='(مخزن)';
        }else{
            $type='(مندوب)';
        }


        return $this->name .'   '.$type;
    }


}
