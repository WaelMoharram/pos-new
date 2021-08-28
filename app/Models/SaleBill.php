<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleBill extends Model 
{

    protected $table = 'sales_bills';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('client_id', 'store_id', 'discount', 'discount_type', 'tax', 'tax_type', 'type', 'total', 'date', 'accept_user_id', 'sales_man_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function salesMan()
    {
        return $this->belongsTo('App\Models\User', 'sales_man_id');
    }

    public function acceptUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function details()
    {
        return $this->hasMany('App\Models\SaleBillDetail');
    }

}