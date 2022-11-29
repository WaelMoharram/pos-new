<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    protected $appends=['color'];
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logUnguarded();
//        // Chain fluent methods for configuration options
//    }
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'upper_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'upper_id');
    }

    public function scopeFinalLevel($query)
    {
        return $query->whereDoesntHave('categories');
    }

    public function getColorAttribute(){
        if($this->categories->count() == 0){
            return 'success';
        }
        if ($this->categories->count() > 0){
            return 'warning';
        }
//        if ($this->category){
//            return 'danger';
//        }




        return 'success';
    }

}
