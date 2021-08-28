<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryTransfer extends Model 
{

    protected $table = 'inventory_transfers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('store_from_id', 'store_to_id', 'accept_user_id');

}