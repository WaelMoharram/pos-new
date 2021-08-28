<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'phone', 'email', 'address', 'notes');

    public function bills()
    {
        return $this->hasMany('App\Models\SaleBill');
    }

}