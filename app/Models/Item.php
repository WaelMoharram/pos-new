<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'image',
        'name',
        'barcode',
        'code',
        'category_id',
        'brand_id',
        'has_options',
        'buy_price',
        'price',
        'min_amount',

    );

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store');
    }



//    public function subItems()
//    {
//        return $this->hasMany('App\Models\SubItem');
//    }

//    public function options()
//    {
//        return $this->belongsToMany(Option::class,'item_option','item_id','option_id');
//    }

    public function Billsdetails()
    {
        return $this->hasMany('App\Models\BillDetail');
    }

    public function getNameWCategoryAttribute(){
        return $this->category->name . ' - '.$this->name;
    }

}
