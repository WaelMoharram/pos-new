<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{

    protected $table = 'optionss';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'note', 'image');

    public function subItems()
    {
        return $this->belongsToMany('App\Models\SubItem','option_sub_item','option_id','sub_item_id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item','item_option','option_id','item_id');
    }

}
