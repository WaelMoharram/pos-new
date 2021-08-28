<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubItem extends Model 
{

    protected $table = 'sub_items';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('amount', 'barcode', 'note', 'item_id', 'price');

    public function options()
    {
        return $this->belongsToMany('App\Models\Option');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function salesBillsDetails()
    {
        return $this->hasMany('App\Models\SaleBillDetail');
    }

}