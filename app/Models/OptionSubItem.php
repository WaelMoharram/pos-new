<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionSubItem extends Model 
{

    protected $table = 'option_sub_item';
    public $timestamps = true;
    protected $fillable = array('option_id', 'sub_item_id', 'option_value');

}