<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseBill extends Model 
{

    protected $table = 'purchases_bills';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('supplier_id', 'date', 'accept_user_id');

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function acceptUser()
    {
        return $this->belongsTo('App\Models\User');
    }

}