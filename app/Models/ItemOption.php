<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model
{

    protected $table = 'item_option';
    public $timestamps = true;
    protected $fillable = array('item_id', 'option_id');
    protected $appends = ['values'];

    public function itemOptionValues(){
        return $this->hasMany(ItemOptionValue::class,'item_option_id');
    }

    public function option(){
        return $this->belongsTo(Option::class);
    }
    public function getValuesAttribute(){
        return $this->itemOptionValues->pluck('value');
    }
}
