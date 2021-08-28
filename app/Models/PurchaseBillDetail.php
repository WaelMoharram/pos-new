<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseBillDetail extends Model 
{

    protected $table = 'purchases_bill_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('bill_id');

    public function bill()
    {
        return $this->belongsTo('App\Models\PurchaseBill');
    }

}