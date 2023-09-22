<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
        if (!Auth::user()->can('index payments')){
            abort(401);
        }

        $payments = Bill::whereIn('type',['cash_in','cash_out'])->get();

        if (auth()->user()->getRoleNames()->first() !='admin'){
            $payments = Bill::whereIn('type',['cash_in','cash_out'])->where('sales_man_id',auth()->id())->get();
        }
        return view('dashboard.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add payments')){
            abort(401);
        }
        $bills = Bill::all()->where('remaining','>',0)->pluck('code_and_name','id');

        return view('dashboard.payments.create',compact('bills'));
    }

    /**
     * Bill a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
//        if (!Auth::user()->can('add payments')){
//            abort(401);
//        }
        $bill = Bill::find($request->bill_id);

        if ($bill->remaining < $request->money){
            toast('لا يمكن سداد المبلغ لان القيمة اكبر من القيمة المتبقية على الفاتورة','error');
            return redirect()->back();
        }

        if ($request->money <=0){
            toast('برجاء ادخال مبلغ صحيح','error');
            return redirect()->back();
        }
        $requests = $request->all();


        $requests['model_id'] =  $bill->model_id;
        $requests['model_type'] =  $bill->model_type;
        $requests['status'] = "saved";
        $requests['need_discount'] = false;


//        if (auth()->user()->type != 'admin'){
            $requests['sales_man_id'] = $request->sales_man_id ?? auth()->id();
            $requests['accept_user_id'] = auth()->id();

//        }else{
//            $requests['accept_user_id'] = auth()->id();
//        }
$lastPayment = Bill::where('type',$request->type)->latest()->first();
        if ($lastPayment){
            $requests['code'] = $lastPayment->code+1;
        }else{
            $requests['code'] =1;
        }
        $payment = Bill::create($requests);

        activity()->withProperties($payment)
            ->log( 'اضافة عملية سداد');
        toast('تم السداد بنجاح','success');
        return redirect()->back();
        return redirect(route('payments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index payments')){
            abort(401);
        }
        $payment = Bill::findOrFail($id);
        return view('dashboard.payments.show',compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit payments')){
            abort(401);
        }
        $payment = Bill::findOrFail($id);
        return view('dashboard.payments.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        if (!Auth::user()->can('edit payments')){
            abort(401);
        }
        $payment = Bill::find($id);

        $payment->fill($request->all())->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete payments')){
            abort(401);
        }
        //TODO:: Bill delete validation

        $payment= Bill::findOrFail($id);

        $payment->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('payments.index'));
    }

    public function print($id){
        $payment = Bill::findOrFail($id);
        return view('dashboard.payments.print',compact('payment'));
    }

}
