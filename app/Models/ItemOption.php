<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model 
{

    protected $table = 'item_option';
    public $timestamps = true;
    protected $fillable = array('item_id', 'option_id');

}