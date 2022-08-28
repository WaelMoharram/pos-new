<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BillDetail extends Model
{

    protected $table = 'bill_details';
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
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

}
