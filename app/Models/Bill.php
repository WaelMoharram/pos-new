<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bill extends Model
{

    protected $table = 'bills';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logUnguarded();
//        // Chain fluent methods for configuration options
//    }
    public function model()
    {
        return $this->morphTo('model');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function storeFrom()
    {
        return $this->belongsTo('App\Models\Store','store_from_id');
    }

    public function storeTo()
    {
        return $this->belongsTo('App\Models\Store','store_to_id');
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
         return $total - ($this->discount??0) + ($this->tax??0);
    }

    public function getCodeAndNameAttribute(){
        return '#'.$this->code . ' - '.$this->model->name;
        return $total - ($this->discount??0) + ($this->tax??0);
    }


    public function getRemainingAttribute(){

        $totalPayments = $this->payments->sum('money');
        $total = $this->details()->sum('total');
        $finalTotal =  $total - ($this->discount??0) + ($this->tax??0);

        return $finalTotal - $totalPayments;
    }


    public function getTypeNameAttribute(){

        switch ($this->type) {
            case "purchase_in":
                return 'فاتوره توريد';
                break;
            case "purchase_out":
                return 'فاتوره مرتجع توريد';
                break;
            case "sale_in":
                return 'فاتوره مرتجع مبيعات';
                break;
            case "sale_out":
                return 'فاتوره مبيعات';
                break;
            case "store":
                return 'نقل وصرف من المخازن و المندوبين';
                break;
            case "cash_in":
                return ' تحصيل من العميل';
                break;
            case "cash_out":
                return 'سداد الى العميل';
                break;
            case "collect":
                return 'تحصيل من المندوب ';
                break;
        }

    }
    public function bill(){
        return $this->belongsTo(Bill::class,'bill_id')->withTrashed();
    }
    public function billNoTrash(){
        return $this->belongsTo(Bill::class,'bill_id');
    }

    public function payments(){
        return $this->hasMany(Bill::class,'bill_id');
    }


}
