<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemStore extends Model
{

    protected $table = 'item_store';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('item_id', 'store_id', 'amount');

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
