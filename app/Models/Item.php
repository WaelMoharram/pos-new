<?php

namespace App\Models;

use http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;

    use SoftDeletes,LogsActivity;

    protected $dates = ['deleted_at'];
    protected $guarded = array(
        'id',

    );
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
        // Chain fluent methods for configuration options
    }
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

    public function getReportAmountAttribute(){
        // get amount of this item in all bills  filter by from_date and to_date

        $amount =0;

        if (request()->has('from_date') && request()->has('to_date')){
            $from_date = request()->get('from_date').' 00:00:00';
            $to_date = request()->get('to_date').' 23:59:59';
            $bills = Bill::whereBetween('created_at',[$from_date,$to_date])->get();

            foreach ($this->billsdetails()->whereIn('bill_id',$bills->pluck('id')->toArray()) as $row){
                $unit = Unit::find($row->unit_id)->ratio;
                $amount = $amount + ($row->amount * $unit);
            }
            return 6;
            return $amount;
        }else{
            foreach ($this->billsdetails()->where('bill_id','!=',null) as $row){
                return $row->amount;
                $unit = Unit::find($row->unit_id)->ratio;
                $amount = $amount + ($row->amount * $unit);
            }
        }


        return 7;

        return $amount;
    }

}
