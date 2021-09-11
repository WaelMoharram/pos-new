<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{

    protected $table = 'stores';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'address', 'sales_man_id', 'is_pos');

    public function subItems()
    {
        return $this->belongsToMany('App\Models\SubItem');
    }

    public function Bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    public function salesMan()
    {
        return $this->hasOne('App\Models\User','sales_man_id');
    }


}
