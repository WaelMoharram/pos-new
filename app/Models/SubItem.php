<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubItem extends Model
{

    protected $table = 'sub_items';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('amount', 'barcode', 'note', 'item_id', 'price','buy_price');
    protected $appends = ['name'];
    public function options()
    {
        return $this->belongsToMany('App\Models\Option','option_sub_item','sub_item_id','option_id');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function BillsDetails()
    {
        return $this->hasMany('App\Models\BillDetail');
    }



    public function OptionSubitems()
    {
        return $this->hasMany(OptionSubItem::class);
    }

    public function getNameAttribute(){
        $name =$this->item->name . '   ';
        foreach ($this->OptionSubitems as $optionSubitem){
            $name .= $optionSubitem->option_value . '   ';
        }
        return $name;
    }

}
