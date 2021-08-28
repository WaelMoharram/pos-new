<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model 
{

    protected $table = 'options';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'note', 'image');

    public function subItems()
    {
        return $this->belongsToMany('App\Models\SubItem');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }

}