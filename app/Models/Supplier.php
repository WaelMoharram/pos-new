<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model 
{

    protected $table = 'suppliers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('phone', 'email', 'note');

    public function bills()
    {
        return $this->hasMany('App\Models\PurchaseBill');
    }

}