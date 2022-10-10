<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\ItemStore;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort(404);
    }

    /**
     * BillDetail a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $taxPercent = option('نسبة القيمة المضافة');
        $taxName = option('اسم القيمة المضافة');


        $bill = Bill::find($request->bill_id);
        $item = Item::find($request->item_id);
        $unit = null;
        if ($request->unit_id){

            $unit = Unit::find($request->unit_id);
        }else{

            $unit = Unit::where('item_id',$item->id)->where('ratio',1)->first();
        }
        if ($bill->status != 'new'){
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ) {
                if ($unit){

                    $item->fill(['amount' => $item->amount + ($request->amount*((1/$unit->ratio) ?? 1))])->save();

                }else{

                    $item->fill(['amount' => $item->amount + $request->amount])->save();


                }
                $storItem = ItemStore::where('store_id', $bill->store_id)->where('item_id', $request->item_id)->first();
                if (!$storItem) {
                    $storItem = ItemStore::create([
                        'store_id' => $bill->store_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }

                $storItem->fill(['amount' => ((float)$storItem->amount ?? 0) + ((float)$request->amount*((1/(float)$unit->ratio) ?? 1))])->save();
            }elseif($bill->type == 'purchase_out' || $bill->type == 'sale_out' ){
                if ($unit){

                    $item->fill(['amount' => (float)$item->amount - ((float)$request->amount*((1/(float)$unit->ratio) ?? 1))])->save();


                }else{

                    $item->fill(['amount' => (float)$item->amount - (float)$request->amount])->save();



                }

                $storItem = ItemStore::where('store_id', $bill->store_id)->where('item_id', $request->item_id)->first();
                if (!$storItem) {
                    $storItem = ItemStore::create([
                        'store_id' => $bill->store_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }

                $storItem->fill(['amount' => ((float)$storItem->amount ?? 0) - ((float)$request->amount*(1/((float)$unit->ratio) ?? 1))])->save();


            }elseif ($bill->type == 'store'){
                $storeFromItem = ItemStore::where('store_id', $bill->store_from_id)->where('item_id', $request->item_id)->first();
                if (!$storeFromItem) {
                    $storeFromItem = ItemStore::create([
                        'store_id' => $bill->store_from_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }
                $storeFromItem->fill(['amount' => ((float)$storeFromItem->amount ?? 0) - ((float)$request->amount*((1/(float)$unit->ratio) ?? 1))])->save();

                $storeToItem = ItemStore::where('store_id', $bill->store_to_id)->where('item_id', $request->item_id)->first();
                if (!$storeToItem) {
                    $storeToItem = ItemStore::create([
                        'store_id' => $bill->store_to_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }
                $storeToItem->fill(['amount' => ((float)$storeToItem->amount ?? 0) + ((float)$request->amount*((float)$unit->ratio ?? 1))])->save();
            }
        }

        if ($bill->type == 'purchase_in' || $bill->type == 'purchase_out' ) {
            $price = $item->buy_price;
            $total = (((float)$request->amount*((1/$unit->ratio) ?? 1)) * (float)$item->buy_price);
            $request->merge(['price' => $price, 'total' => $total]);
        }else{
            $price = ((float)$unit->price ?? (float)$item->price);
            if ($request->discount >0){
                $price = ((float)$unit->price ?? (float)$item->price) - (float)$request->discount;
            }
            $total = ((float)$request->amount * $price);
            $request->merge(['price' => $price, 'total' => $total]);
        }
        $BillDetail = BillDetail::where('item_id',$request->item_id)->where('bill_id',$request->bill_id)->where('unit_id',$unit->id ?? null)->first();
        if ($BillDetail){
            $price = ((float)$unit->price ?? (float)$item->price);
            if ($request->discount >0){
                $price = ((float)$unit->price ?? (float)$item->price) - (float)$request->discount;
            }
            $newAmount = (float)$BillDetail->amount + ((float)$request->amount*((1/(float)$unit->ratio) ?? 1));
            $total = ($newAmount * $price);
            $detail = $BillDetail->fill(['amount'=>$newAmount,'price'=>$price,'total'=>$total])->save();
        }else{
            $detail = BillDetail::create($request->all());
        }

        if ($bill->pos_sales == 1 && $bill->type != 'store'){
            $requestsBay['item_id'] = $item->id;
            $requestsBay['bill_id'] = $bill->id;
            $requestsBay['model_id'] = $bill->model_id;
            $requestsBay['model_type'] = $bill->model_type;
            $requestsBay['date'] = date('Y-m-d');
            $requestsBay['status'] = "saved";
            $requestsBay['money'] = $total;
            $requestsBay['need_discount'] = false;
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ) {
                $requestsBay['type'] = "cash_out";
            }elseif($bill->type == 'purchase_out' || $bill->type == 'sale_out' ) {
                $requestsBay['type'] = "cash_in";
            }


            $requestsBay['sales_man_id'] = auth()->id();
            $requestsBay['accept_user_id'] = auth()->id();
            $lastPayment = Bill::where('type','cash_in')->latest()->first();
            if ($lastPayment){
                $requestsBay['code'] = $lastPayment->code+1;
            }else{
                $requestsBay['code'] =1;
            }

            return ['item_id'=>$request->item_id,'bill_id'=>$bill->bill_id];
            $payment = Bill::where('item_id',$request->item_id)->where('bill_id',$bill->bill_id)->first();

            if ($payment){
                $payment->fill($requestsBay)->save();
            }else{

                $payment = Bill::create($requestsBay);
            }
        }
        if ($taxPercent != null && $taxPercent > 0) {
            $bill->update(['tax' => ($bill->total * ($taxPercent / 100)), 'tax_type' => $taxName]);
        }
//        toast('تم اضافة القيد بنجاح','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillDetailRequest $request, $id)
    {

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:: BillDetail delete validation
//        if (){
//            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
//            return back();
//        }
        $detail= BillDetail::findOrFail($id);
        $item = Item::find($detail->item_id);

        if ($detail->bill->status != 'new') {
            if ($detail->bill->type == 'purchase_in' || $detail->bill->type == 'sale_in') {
                $item->fill(['amount' => $item->amount - $detail->amount])->save();


                $storItem = ItemStore::where('store_id', $detail->bill->store_id)->where('item_id', $detail->item_id)->first();
                if (!$storItem) {
                    $storItem = ItemStore::create([
                        'store_id' => $detail->bill->store_id,
                        'item_id' => $detail->item_id,
                        'amount' => 0
                    ]);
                }

                $storItem->fill(['amount' => ($storItem->amount ?? 0) - $detail->amount])->save();
            }elseif ($detail->bill->type == 'purchase_out' || $detail->bill->type == 'sale_out'){
                $item->fill(['amount' => $item->amount + $detail->amount])->save();


                $storItem = ItemStore::where('store_id', $detail->bill->store_id)->where('item_id', $detail->item_id)->first();
                if (!$storItem) {
                    $storItem = ItemStore::create([
                        'store_id' => $detail->bill->store_id,
                        'item_id' => $detail->item_id,
                        'amount' => 0
                    ]);
                }

                $storItem->fill(['amount' => ($storItem->amount ?? 0) + $detail->amount])->save();
            }elseif ($detail->bill->type == 'store'){
                $storeFromItem = ItemStore::where('store_id', $detail->bill->store_from_id)->where('item_id', $detail->item_id)->first();
                if (!$storeFromItem) {
                    $storeFromItem = ItemStore::create([
                        'store_id' => $detail->bill->store_from_id,
                        'item_id' => $detail->item_id,
                        'amount' => 0
                    ]);
                }
                $storeFromItem->fill(['amount' => ($storeFromItem->amount ?? 0) - $detail->amount])->save();

                $storeToItem = ItemStore::where('store_id', $detail->bill->store_to_id)->where('item_id', $detail->item_id)->first();
                if (!$storeToItem) {
                    $storeToItem = ItemStore::create([
                        'store_id' => $detail->bill->store_to_id,
                        'item_id' => $detail->item_id,
                        'amount' => 0
                    ]);
                }
                $storeToItem->fill(['amount' => ($storeToItem->amount ?? 0) + $detail->amount])->save();
            }
        }

        if ($detail->bill->pos_sales == 1 && $detail->bill->type != 'store'){
            $requestsBay['item_id'] = $item->id;
            $requestsBay['bill_id'] = $detail->bill->id;
            $requestsBay['model_id'] = $detail->bill->model_id;
            $requestsBay['model_type'] = $detail->bill->model_type;
            $requestsBay['date'] = date('Y-m-d');
            $requestsBay['status'] = "saved";
            $requestsBay['money'] = $detail->total;
            $requestsBay['need_discount'] = false;
            if ($detail->bill->type == 'purchase_in' || $detail->bill->type == 'sale_in' ) {
                $requestsBay['type'] = "cash_out";
            }elseif($detail->bill->type == 'purchase_out' || $detail->bill->type == 'sale_out' ) {
                $requestsBay['type'] = "cash_in";
            }


            $requestsBay['sales_man_id'] = auth()->id();
            $requestsBay['accept_user_id'] = auth()->id();
            $lastPayment = Bill::where('type','cash_in')->latest()->first();
            if ($lastPayment){
                $requestsBay['code'] = $lastPayment->code+1;
            }else{
                $requestsBay['code'] =1;
            }
            $payment = Bill::where('item_id',$detail->item_id)->where('bill_id',$detail->bill->bill_id)->first();

            if ($payment){
                $payment->fill($requestsBay)->save();
            }else{

                $payment = Bill::create($requestsBay);
            }
        }
        $detail->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}
