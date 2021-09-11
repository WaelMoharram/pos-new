<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOptionValue extends Model
{

    protected $table = 'item_option_values';
    public $timestamps = true;
    protected $fillable = array('item_option_id', 'value');
    //protected $with = ['itemOption'];


    public function itemOption(){
        return $this->belongsTo(ItemOption::class,'item_option_id');
    }

}
