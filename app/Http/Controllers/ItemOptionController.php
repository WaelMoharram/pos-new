<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemOptionRequest;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\Option;
use Illuminate\Http\Request;

class ItemOptionController extends Controller
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
    public function index(Request $request)
    {
        $item = Item::find($request->item_id);
        $canNotMakeActions =  $item->is_final_options;
        $options = ItemOption::where('item_id',$request->item_id)->get();
        $optiondIDs = ItemOption::where('item_id',$request->item_id)->pluck('option_id');
        $forSelectOptions = Option::whereNotIn('id',$optiondIDs)->pluck('name','id');
        $itemName = optional(Item::find($request->item_id))->name;
        return view('dashboard.item-options.index',compact('options','itemName','forSelectOptions','canNotMakeActions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Option a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $option = ItemOption::create($request->all());

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('item-options.index',['item_id'=>$request->item_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = ItemOption::findOrFail($id);

        return view('dashboard.item-options.show',compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = ItemOption::findOrFail($id);

        return view('dashboard.item-options.edit',compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemOptionRequest $request, $id)
    {

        $option = ItemOption::find($id);

        $option->fill($request->all())->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('item-options.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:: Option delete validation
//        if (){
//            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
//            return back();
//        }
        $option= ItemOption::findOrFail($id);
        $itemID= $option->item_id;
        $option->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('item-options.index',['item_id'=>$itemID]));
    }
}
