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

                $storItem->fill(['amount' => ($storItem->amount ?? 0) + ($request->amount*((1/$unit->ratio) ?? 1))])->save();
            }elseif($bill->type == 'purchase_out' || $bill->type == 'sale_out' ){
                if ($unit){

                    $item->fill(['amount' => $item->amount - ($request->amount*((1/$unit->ratio) ?? 1))])->save();
                }else{

                    $item->fill(['amount' => $item->amount - $request->amount])->save();
                }

                $storItem = ItemStore::where('store_id', $bill->store_id)->where('item_id', $request->item_id)->first();
                if (!$storItem) {
                    $storItem = ItemStore::create([
                        'store_id' => $bill->store_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }

                $storItem->fill(['amount' => ($storItem->amount ?? 0) - ($request->amount*(1/($unit->ratio) ?? 1))])->save();


            }elseif ($bill->type == 'store'){
                $storeFromItem = ItemStore::where('store_id', $bill->store_from_id)->where('item_id', $request->item_id)->first();
                if (!$storeFromItem) {
                    $storeFromItem = ItemStore::create([
                        'store_id' => $bill->store_from_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }
                $storeFromItem->fill(['amount' => ($storeFromItem->amount ?? 0) - ($request->amount*((1/$unit->ratio) ?? 1))])->save();

                $storeToItem = ItemStore::where('store_id', $bill->store_to_id)->where('item_id', $request->item_id)->first();
                if (!$storeToItem) {
                    $storeToItem = ItemStore::create([
                        'store_id' => $bill->store_to_id,
                        'item_id' => $request->item_id,
                        'amount' => 0
                    ]);
                }
                $storeToItem->fill(['amount' => ($storeToItem->amount ?? 0) + ($request->amount*($unit->ratio ?? 1))])->save();
            }
        }

        if ($bill->type == 'purchase_in' || $bill->type == 'purchase_out' ) {
            $request->merge(['price' => $item->buy_price, 'total' => (($request->amount*((1/$unit->ratio) ?? 1)) * $item->buy_price)]);
        }else{
            $price = ($unit->price ?? $item->price);
            if ($request->discount >0){
                $price = ($unit->price ?? $item->price) - $request->discount;
            }
            $request->merge(['price' => $price, 'total' => ($request->amount * $price)]);
        }
        $BillDetail = BillDetail::where('item_id',$request->item_id)->where('bill_id',$request->bill_id)->where('unit_id',$unit->id ?? null)->first();
        if ($BillDetail){
            $price = ($unit->price ?? $item->price);
            if ($request->discount >0){
                $price = ($unit->price ?? $item->price) - $request->discount;
            }
            $newAmount = $BillDetail->amount + ($request->amount*((1/$unit->ratio) ?? 1));
            $detail = $BillDetail->fill(['amount'=>$newAmount,'price'=>$price,'total'=>($newAmount * $price)])->save();
        }else{
            $detail = BillDetail::create($request->all());
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
        $detail->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}
