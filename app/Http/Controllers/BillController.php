<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemStore;
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
        return auth()->user()->store;
        if ($request->type == 'sale_in' || $request->type == 'sale_out'){
            if (auth()->user()->has('store') && auth()->user()->store->is_pos == 0){
                toast('لا يمكن اتمام عمليات بيع فى هذا المخزن','error');
                return redirect()->back();
            }
        }
        $bills = Bill::where('type',$request->type)->orderByDesc('id')->get();
        if (auth()->user()->store()->count() > 0){
            $bills = Bill::where('type',$request->type)->where(function($q) use($request){
                $q->where('sales_man_id',auth()->id())->orWhere('store_id',auth()->user()->store_id);
            })->orderByDesc('id')->get();

        }
        $store = auth()->user()->store;

        return view('dashboard.bills.'.$request->type.'.index',compact('bills','store'));
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

        $requests['status'] = "saved";
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


        if (auth()->user()->type != 'admin'){
            $requests['sales_man_id'] = auth()->id();
            $requests['accept_user_id'] = auth()->id();
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
        $items = Item::all();
        return view('dashboard.bills.'.$bill->type.'.edit',compact('bill','details','items'));
    }

    public function editPos()
    {

        if (auth()->user()->pos == 1 ){

            if (auth()->user()->has('store') && auth()->user()->store->is_pos == 0){
                toast('لا يمكن اتمام عمليات بيع فى هذا المخزن','error');
                return redirect()->back();
            }
            $requests['status'] = "saved";
            $requests['need_discount'] = false;
            $requests['type'] = "sale_out";
            $requests['model_type'] = "client";
            $requests['model_id'] = 1;

            if (auth()->user()->type != 'admin'){
                $requests['sales_man_id'] = auth()->id();
                $requests['accept_user_id'] = auth()->id();
            }else{
                $requests['accept_user_id'] = auth()->id();
            }
            $lastBill = Bill::where('type','sale_out')->latest()->first();
            if ($lastBill){
                $requests['code'] = $lastBill->code+1;
            }else{
                $requests['code'] =1;
            }
            $requests['store_id']=auth()->user()->store->id ?? 0;
            $requests['date']=date('Y-m-d');
            $bill = Bill::where('type','sale_out')->where('date',date('Y-m-d'))->where('accept_user_id',auth()->id())->first();
            if (!$bill){
                $bill = Bill::create($requests);

            }
            $details = BillDetail::where('bill_id',$bill->id)->get();
            $items = Item::all();

            return view('dashboard.bills.sale_out_pos.edit',compact('bill','details','items'));
        }

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
                    $item = Item::find($detail->item_id);
                    $item->fill(['amount'=>$item->amount +$detail->amount])->save();
                    $storItem = ItemStore::where('store_id',$bill->store_id)->where('item_id',$detail->item_id)->first();
                    if (!$storItem){
                        $storItem = ItemStore::create([
                            'store_id'=>$bill->store_id,
                            'item_id'=>$detail->item_id,
                            'amount'=>0
                        ]);
                    }

                    $storItem->fill(['amount'=>($storItem->amount ?? 0) +$detail->amount])->save();
                }
            }elseif($bill->type == 'purchase_out' || $bill->type == 'sale_out' ){
                foreach ($bill->details as $detail){
                    $item = Item::find($detail->item_id);
                    $item->fill(['amount'=>$item->amount -$detail->amount])->save();
                    $storItem = ItemStore::where('store_id',$bill->store_id)->where('item_id',$detail->item_id)->first();
                    if (!$storItem){
                        $storItem = ItemStore::create([
                            'store_id'=>$bill->store_id,
                            'item_id'=>$detail->item_id,
                            'amount'=>0
                        ]);
                    }

                    $storItem->fill(['amount'=>($storItem->amount ?? 0) -$detail->amount])->save();
                }
            }elseif($bill->type == 'store'){
                foreach ($bill->details as $detail){
                    //in to out

                    $storeFromItem = ItemStore::where('store_id',$bill->store_from_id)->where('item_id',$detail->item_id)->first();
                    if (!$storeFromItem){
                        $storeFromItem = ItemStore::create([
                            'store_id'=>$bill->store_from_id,
                            'item_id'=>$detail->item_id,
                            'amount'=>0
                        ]);
                    }

                    $storeFromItem->fill(['amount'=>($storeFromItem->amount ?? 0) - $detail->amount])->save();

                    //#################################################

                    //out to in
                    $storeToItem = ItemStore::where('store_id',$bill->store_to_id)->where('item_id',$detail->item_id)->first();
                    if (!$storeToItem){
                        $storeToItem = ItemStore::create([
                            'store_id'=>$bill->store_to_id,
                            'item_id'=>$detail->item_id,
                            'amount'=>0
                        ]);
                    }

                    $storeToItem->fill(['amount'=>($storeToItem->amount ?? 0) - $detail->amount])->save();
                }
            }
        }
        $bill->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('bills.index',['type'=>$bill->type]));
    }

    public function save($id,Request $request){
        $bill= Bill::findOrFail($id);

        if ($bill->status == 'new'){
            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in' ) {
                foreach ($bill->details as $detail) {
                    $item = Item::find($detail->item_id);
                    $item->fill(['amount' => $item->amount + $detail->amount])->save();
                    $storItem = ItemStore::where('store_id', $bill->store_id)->where('item_id', $detail->item_id)->first();
                    if (!$storItem) {
                        $storItem = ItemStore::create([
                            'store_id' => $bill->store_id,
                            'item_id' => $detail->item_id,
                            'amount' => 0
                        ]);
                    }

                    $storItem->fill(['amount' => ($storItem->amount ?? 0) + $detail->amount])->save();
                }
            }elseif ($bill->type == 'purchase_out' || $bill->type == 'sale_out' ) {
                foreach ($bill->details as $detail) {
                    $item = Item::find($detail->item_id);
                    $item->fill(['amount' => $item->amount - $detail->amount])->save();
                    $storItem = ItemStore::where('store_id', $bill->store_id)->where('item_id', $detail->item_id)->first();
                    if (!$storItem) {
                        $storItem = ItemStore::create([
                            'store_id' => $bill->store_id,
                            'item_id' => $detail->item_id,
                            'amount' => 0
                        ]);
                    }

                    $storItem->fill(['amount' => ($storItem->amount ?? 0) - $detail->amount])->save();
                }
            }elseif ($bill->type == 'store') {
                foreach ($bill->details as $detail) {

                    $storeFromItem = ItemStore::where('store_id', $bill->store_from_id)->where('item_id', $detail->item_id)->first();
                    if (!$storeFromItem) {
                        $storeFromItem = ItemStore::create([
                            'store_id' => $bill->store_from_id,
                            'item_id' => $detail->item_id,
                            'amount' => 0
                        ]);
                    }

                    $storeFromItem->fill(['amount' => ($storeFromItem->amount ?? 0) - $detail->amount])->save();

                    $storeToItem = ItemStore::where('store_id', $bill->store_to_id)->where('item_id', $detail->item_id)->first();
                    if (!$storeToItem) {
                        $storeToItem = ItemStore::create([
                            'store_id' => $bill->store_to_id,
                            'item_id' => $detail->item_id,
                            'amount' => 0
                        ]);
                    }

                    $storeToItem->fill(['amount' => ($storeToItem->amount ?? 0) + $detail->amount])->save();
                }
            }
        }

        $bill->fill(['status'=>'saved'])->save();

        if ($request->has('pay') && $request->pay ==1){
            if ($bill->remaining < $request->money){
                toast('لا يمكن سداد المبلغ لان القيمة اكبر من القيمة المتبقية على الفاتورة','error');
                return redirect()->back();
            }
            $requests = $request->all();

            $requests['bill_id'] = $bill->id;

            $requests['model_id'] = $bill->model_id;
            $requests['model_type'] = $bill->model_type;
            $requests['date'] = $request->money_date;
            $requests['status'] = "saved";
            $requests['need_discount'] = false;

            if ($bill->type == 'purchase_in' || $bill->type == 'sale_in') {
                $requests['type'] = "cash_out";
            }else {
                $requests['type'] = "cash_in";
            }


            if (auth()->user()->type == 'sales'){
                $requests['sales_man_id'] = auth()->id();
                $requests['accept_user_id'] = auth()->id();

            }else{
                $requests['accept_user_id'] = auth()->id();
            }
            $lastPayment = Bill::where('type',$request->type)->latest()->first();
            if ($lastPayment){
                $requests['code'] = $lastPayment->code+1;
            }else{
                $requests['code'] =1;
            }
            $payment = Bill::create($requests);
            toast('تم السداد بنجاح','success');
        }
        toast('تم حفظ الفاتورة بنجاح','success');

        return redirect(route('bills.index',['type'=>$bill->type]));
    }
    public function print($id){
        $bill = Bill::findOrFail($id);
        $details = BillDetail::where('bill_id',$bill->id)->get();
        return view('dashboard.bills.'.$bill->type.'.print',compact('bill','details'));
    }
    public function printBarcode($id){
        $bill = Bill::findOrFail($id);
        $details = BillDetail::where('bill_id',$bill->id)->get();
        $count =1;
        return view('dashboard.bills.'.$bill->type.'.print-barcode',compact('bill','details','count'));
    }
}
