<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleBillDetail extends Model 
{

    protected $table = 'sales_bill_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('item_id', 'sub_item_id', 'amount', 'price', 'total', 'bill_id');

    public function bill()
    {
        return $this->belongsTo('App\Models\SaleBill');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function subItem()
    {
        return $this->belongsTo('App\Models\SubItem');
    }

}