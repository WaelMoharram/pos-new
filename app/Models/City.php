<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function getNameAttribute(){
        if (app()->getLocale() == 'ar'){
            return $this->city_name_ar;
        }
        return $this->city_name_en;

    }

    public function getNameWithGovernorateAttribute(){
        return $this->city_name_ar . ' - ' .optional($this->governorate)->name;
    }

}
