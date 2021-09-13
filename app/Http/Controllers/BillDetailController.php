<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\StoreSubItem;
use App\Models\SubItem;
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
        $bill = Bill::find($request->bill_id);
        $subItem = SubItem::find($request->sub_item_id);
        if ($bill->status != 'new'){
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ) {
                $subItem->fill(['amount' => $subItem->amount + $request->amount])->save();
                $storSubItem = StoreSubItem::where('store_id', $bill->store_id)->where('sub_item_id', $request->sub_item_id)->first();
                if (!$storSubItem) {
                    $storSubItem = StoreSubItem::create([
                        'store_id' => $bill->store_id,
                        'sub_item_id' => $request->sub_item_id,
                        'amount' => 0
                    ]);
                }

                $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) + $request->amount])->save();
            }else{
                $subItem->fill(['amount' => $subItem->amount - $request->amount])->save();
                $storSubItem = StoreSubItem::where('store_id', $bill->store_id)->where('sub_item_id', $request->sub_item_id)->first();
                if (!$storSubItem) {
                    $storSubItem = StoreSubItem::create([
                        'store_id' => $bill->store_id,
                        'sub_item_id' => $request->sub_item_id,
                        'amount' => 0
                    ]);
                }

                $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) - $request->amount])->save();
            }
        }

        $request->merge(['item_id'=>$subItem->item_id,'price'=>$subItem->price,'total'=>($request->amount * $subItem->price)]);
        $BillDetail = BillDetail::where('sub_item_id',$request->sub_item_id)->where('bill_id',$request->bill_id)->first();
        if ($BillDetail){
            $newAmount = $BillDetail->amount + $request->amount;
            $detail = $BillDetail->fill(['amount'=>$newAmount,'price'=>$subItem->price,'total'=>($newAmount * $subItem->price)])->save();
        }else{
            $detail = BillDetail::create($request->all());
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
        $subItem = SubItem::find($detail->sub_item_id);

        if ($detail->bill->status != 'new') {
            if ($detail->bill->type == 'purchase_in' || $detail->bill->type == 'sale_in') {
                $subItem->fill(['amount' => $subItem->amount - $detail->amount])->save();
                $storSubItem = StoreSubItem::where('store_id', $detail->bill->store_id)->where('sub_item_id', $detail->sub_item_id)->first();
                if (!$storSubItem) {
                    $storSubItem = StoreSubItem::create([
                        'store_id' => $detail->bill->store_id,
                        'sub_item_id' => $detail->sub_item_id,
                        'amount' => 0
                    ]);
                }

                $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) - $detail->amount])->save();
            }else{
                $subItem->fill(['amount' => $subItem->amount + $detail->amount])->save();
                $storSubItem = StoreSubItem::where('store_id', $detail->bill->store_id)->where('sub_item_id', $detail->sub_item_id)->first();
                if (!$storSubItem) {
                    $storSubItem = StoreSubItem::create([
                        'store_id' => $detail->bill->store_id,
                        'sub_item_id' => $detail->sub_item_id,
                        'amount' => 0
                    ]);
                }

                $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) + $detail->amount])->save();
            }
        }
        $detail->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}
