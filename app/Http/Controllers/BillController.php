<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\StoreSubItem;
use App\Models\SubItem;
use Illuminate\Http\Request;

class BillController extends Controller
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
        $bills = Bill::where('type',$request->type)->get();
        return view('dashboard.bills.'.$request->type.'.index',compact('bills'));
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
     * Bill a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $requests = $request->all();

        $requests['status'] = "new";
        $requests['need_discount'] = false;
        switch ($request->type) {
            case "purchase_in":
                $requests['type'] = "purchase_in";
                $requests['model_type'] = "supplier";
                break;
            case "purchase_out":
                $requests['type'] = "purchase_out";
                $requests['model_type'] = "supplier";
                break;
            case "sale_in":
                $requests['type'] = "sale_in";
                $requests['model_type'] = "client";
                break;
            case "sale_out":
                $requests['type'] = "sale_out";
                $requests['model_type'] = "client";
                break;
            case "store":
                $requests['type'] = "store";
                $requests['model_type'] = "null";
                break;
        }


        if (auth()->user()->type == 'sales'){
            $requests['sales_man_id'] = auth()->id();
        }else{
            $requests['accept_user_id'] = auth()->id();
        }
        $lastBill = Bill::where('type',$request->type)->latest()->first();
        if ($lastBill){
            $requests['code'] = $lastBill->code+1;
        }else{
            $requests['code'] =1;
        }
        $bill = Bill::create($requests);
        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('bills.edit',$bill->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);
        $details = BillDetail::where('bill_id',$bill->id)->get();
        return view('dashboard.bills.'.$bill->type.'.show',compact('bill','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $details = BillDetail::where('bill_id',$bill->id)->get();
        $items = SubItem::all();
        return view('dashboard.bills.'.$bill->type.'.edit',compact('bill','details','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $bill = Bill::find($id);

        $requests = $request->all();
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $bill->fill($requests)->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('bills.index',['type'=>$bill->type]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:: Bill delete validation
//        if (){
//            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
//            return back();
//        }
        $bill= Bill::findOrFail($id);

        if ($bill->status == 'saved' ){
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ){
                foreach ($bill->details as $detail){
                    $subItem = SubItem::find($detail->sub_item_id);
                    $subItem->fill(['amount'=>$subItem->amount +$detail->amount])->save();
                    $storSubItem = StoreSubItem::where('store_id',$bill->store_id)->where('sub_item_id',$detail->sub_item_id)->first();
                    if (!$storSubItem){
                        $storSubItem = StoreSubItem::create([
                            'store_id'=>$bill->store_id,
                            'sub_item_id'=>$detail->sub_item_id,
                            'amount'=>0
                        ]);
                    }

                    $storSubItem->fill(['amount'=>($storSubItem->amount ?? 0) +$detail->amount])->save();
                }
            }elseif($bill->type == 'purchase_out' || $bill->type == 'sale_out' ){
                foreach ($bill->details as $detail){
                    $subItem = SubItem::find($detail->sub_item_id);
                    $subItem->fill(['amount'=>$subItem->amount -$detail->amount])->save();
                    $storSubItem = StoreSubItem::where('store_id',$bill->store_id)->where('sub_item_id',$detail->sub_item_id)->first();
                    if (!$storSubItem){
                        $storSubItem = StoreSubItem::create([
                            'store_id'=>$bill->store_id,
                            'sub_item_id'=>$detail->sub_item_id,
                            'amount'=>0
                        ]);
                    }

                    $storSubItem->fill(['amount'=>($storSubItem->amount ?? 0) -$detail->amount])->save();
                }
            }elseif($bill->type == 'store'){
                foreach ($bill->details as $detail){
                    //in to out

                    $storeFromSubItem = StoreSubItem::where('store_id',$bill->store_from_id)->where('sub_item_id',$detail->sub_item_id)->first();
                    if (!$storeFromSubItem){
                        $storeFromSubItem = StoreSubItem::create([
                            'store_id'=>$bill->store_from_id,
                            'sub_item_id'=>$detail->sub_item_id,
                            'amount'=>0
                        ]);
                    }

                    $storeFromSubItem->fill(['amount'=>($storeFromSubItem->amount ?? 0) - $detail->amount])->save();

                    //#################################################

                    //out to in
                    $storeToSubItem = StoreSubItem::where('store_id',$bill->store_to_id)->where('sub_item_id',$detail->sub_item_id)->first();
                    if (!$storeToSubItem){
                        $storeToSubItem = StoreSubItem::create([
                            'store_id'=>$bill->store_to_id,
                            'sub_item_id'=>$detail->sub_item_id,
                            'amount'=>0
                        ]);
                    }

                    $storeToSubItem->fill(['amount'=>($storeToSubItem->amount ?? 0) - $detail->amount])->save();
                }
            }
        }
        $bill->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('bills.index',['type'=>$bill->type]));
    }

    public function save($id){
        $bill= Bill::findOrFail($id);

        if ($bill->status == 'new'){
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ) {
                foreach ($bill->details as $detail) {
                    $subItem = SubItem::find($detail->sub_item_id);
                    $subItem->fill(['amount' => $subItem->amount + $detail->amount])->save();
                    $storSubItem = StoreSubItem::where('store_id', $bill->store_id)->where('sub_item_id', $detail->sub_item_id)->first();
                    if (!$storSubItem) {
                        $storSubItem = StoreSubItem::create([
                            'store_id' => $bill->store_id,
                            'sub_item_id' => $detail->sub_item_id,
                            'amount' => 0
                        ]);
                    }

                    $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) + $detail->amount])->save();
                }
            }elseif ($bill->type == 'purchase_out' || $bill->type == 'sale_out' ) {
                foreach ($bill->details as $detail) {
                    $subItem = SubItem::find($detail->sub_item_id);
                    $subItem->fill(['amount' => $subItem->amount - $detail->amount])->save();
                    $storSubItem = StoreSubItem::where('store_id', $bill->store_id)->where('sub_item_id', $detail->sub_item_id)->first();
                    if (!$storSubItem) {
                        $storSubItem = StoreSubItem::create([
                            'store_id' => $bill->store_id,
                            'sub_item_id' => $detail->sub_item_id,
                            'amount' => 0
                        ]);
                    }

                    $storSubItem->fill(['amount' => ($storSubItem->amount ?? 0) - $detail->amount])->save();
                }
            }elseif ($bill->type == 'store') {
                foreach ($bill->details as $detail) {

                    $storeFromSubItem = StoreSubItem::where('store_id', $bill->store_from_id)->where('sub_item_id', $detail->sub_item_id)->first();
                    if (!$storeFromSubItem) {
                        $storeFromSubItem = StoreSubItem::create([
                            'store_id' => $bill->store_from_id,
                            'sub_item_id' => $detail->sub_item_id,
                            'amount' => 0
                        ]);
                    }

                    $storeFromSubItem->fill(['amount' => ($storeFromSubItem->amount ?? 0) - $detail->amount])->save();

                    $storeToSubItem = StoreSubItem::where('store_id', $bill->store_to_id)->where('sub_item_id', $detail->sub_item_id)->first();
                    if (!$storeToSubItem) {
                        $storeToSubItem = StoreSubItem::create([
                            'store_id' => $bill->store_to_id,
                            'sub_item_id' => $detail->sub_item_id,
                            'amount' => 0
                        ]);
                    }

                    $storeToSubItem->fill(['amount' => ($storeToSubItem->amount ?? 0) + $detail->amount])->save();
                }
            }
        }

        $bill->fill(['status'=>'saved'])->save();
        toast('تم حفظ الفاتورة بنجاح','success');

        return redirect()->back();
    }
    public function print($id){
        $bill = Bill::findOrFail($id);
        $details = BillDetail::where('bill_id',$bill->id)->get();
        return view('dashboard.bills.'.$bill->type.'.print',compact('bill','details'));
    }
}
