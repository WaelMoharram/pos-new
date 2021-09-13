<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{

    protected $table = 'bills';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function model()
    {
        return $this->morphTo('model');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function acceptUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function details(){
        return $this->hasMany(BillDetail::class);
    }

    public function getTotalAttribute(){
         $total = $this->details()->sum('total');
         return $total - $this->discount??0 + $this->tax??0;
    }


}
