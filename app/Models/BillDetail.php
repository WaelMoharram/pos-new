<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{

    protected $table = 'bill_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

}
