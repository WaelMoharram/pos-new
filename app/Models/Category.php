<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'image','upper_id');
    protected $appends=['color'];

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
