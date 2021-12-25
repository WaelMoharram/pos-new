<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Client;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','notsales']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('dashboard.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier=new Supplier();
        return view('dashboard.suppliers.create',compact('supplier'));
    }

    /**
     * Supplier a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {

        $supplier = Supplier::create($request->all());

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('suppliers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('dashboard.suppliers.show',compact('supplier'));
    }

    public function report($id)
    {
        $supplier = Supplier::findOrFail($id);
        $bills = $supplier->bills;

        $billsIn = $supplier->bills->where('type','purchase_in')->where('status','saved')->sum('total');
        $billsOut = $supplier->bills->where('type','purchase_out')->where('status','saved')->sum('total');
        $cashIn = $supplier->bills->where('type','cash_in')->sum('money');
        $cashOut = $supplier->bills->where('type','cash_out')->sum('money');

        $total =  $billsIn - $billsOut -$cashOut + $cashIn;

        return view('dashboard.suppliers.report',compact('supplier','bills','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('dashboard.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {

        $supplier = Supplier::find($id);
        $supplier->fill($request->all())->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('suppliers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:: Supplier delete validation
//        if (){
//            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
//            return back();
//        }
        $supplier= Supplier::findOrFail($id);
        if ($supplier->bills->count() > 0){
            toast('لا يمكن حذف المورد لوجود فواتير له','error');
            return redirect()->back();
        }
        $supplier->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('suppliers.index'));
    }
}
