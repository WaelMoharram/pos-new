<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
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
        if (!Auth::user()->can('index stores')){
            abort(401);
        }
        $stores = Store::where('sales_man_id',null)->where(function ($q){
            if (Auth::user()->store_id != null){
                $q->where('id',Auth::user()->store_id);
            }
        })->get();
        activity()
            ->log( 'عرض المخازن');
        return view('dashboard.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add stores')){
            abort(401);
        }
        $store=new Store();
        return view('dashboard.stores.create',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if (!Auth::user()->can('add stores')){
            abort(401);
        }
        $requests = $request->all();
        $requests['is_pos'] = 1;
        $store = Store::create($requests);
        activity()->withProperties($store)
            ->log( 'اضافة مخزن جديد');
        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('stores.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index stores')){
            abort(401);
        }
        $store = Store::findOrFail($id);
        $items = \App\Models\Item::where(function($q){
            if (request()->has('name') && request()->name != null){
                $q->where('name','like','%'.request()->name.'%');
            }
            if (request()->has('barcode') && request()->barcode != null){
                $q->where('barcode','like','%'.request()->barcode.'%');
            }
        })->paginate(15);

        return view('dashboard.stores.show',compact('store','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit stores')){
            abort(401);
        }
        $store = Store::findOrFail($id);

        return view('dashboard.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        if (!Auth::user()->can('edit stores')){
            abort(401);
        }
        $store = $storeOld = Store::find($id);
        $store->fill($request->all())->save();
        activity()->withProperties(['old'=>$storeOld,'attributes'=>$store])
            ->log( 'تعديل بيانات مخزن');
        toast('تم التعديل بنجاح ','success');
        return redirect(route('stores.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete stores')){
            abort(401);
        }
        //TODO:: Store delete validation

        $store= Store::findOrFail($id);
        if ($store->bills->count() > 0){
            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
            return back();
        }
        activity()->withProperties($store)
            ->log( 'حذف مخزن');
        $store->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('stores.index'));
    }

    public function all()
    {

        return view('dashboard.stores.all');
    }
}
