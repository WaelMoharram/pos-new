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
    protected $fillable = array('name', 'phone', 'email', 'address', 'notes','sales_man_id');

    public function bills()
    {
        return $this->morphMany('App\Models\Bill','model');
    }

    public function salesMan()
    {
        return $this->belongsTo(User::class,'sales_man_id');
    }
    public function scopeCheck($query)
    {
        if (\Auth::user()->type == 'sales') {

            return $query->where('sales_man_id', \Auth::id());
        }
    }

}
