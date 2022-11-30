<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\BillDetail;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
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
        $units = Unit::where('item_id',$request->item_id)->get();
        if (count($units) == 0){
            Unit::create([
                'item_id'=>$request->item_id,
                'price'=>Item::find($request->item_id)->price,
                'name'=>'الوحدة الكبرى'
            ]);
            $units = Unit::where('item_id',$request->item_id)->get();
        }

        activity()->withProperties($units)
            ->log( 'عرض الوحدات');
        return view('dashboard.units.index',compact('units'));
    }
    public function create(Request  $request)
    {
        $unit=new Unit();
        $item_id = $request->item_id;
        return view('dashboard.units.create',compact('unit','item_id'));
    }

    /**
     * Unit a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        $requests=$request->all();

        $unit = Unit::create($requests);
        activity()->withProperties([$unit])
            ->log( 'اضافة وحدة جديدة');
        toast('تم اضافة الوحدة بنجاح','success');
        return redirect(route('units.index',['item_id'=>$unit->item_id]));
    }


    public function edit($id)
    {
        $unit=Unit::find($id);

        return view('dashboard.units.edit',compact('unit'));
    }

    public function update(UnitRequest $request,$id)
    {
        $requests=$request->all();

        $unit = $unitOld = Unit::find($id);
        $unit->fill($requests)->save();
        activity()->withProperties(['old'=>$unitOld,'attributes'=>$unit])
            ->log( 'تعديل وحدة');
        toast('تم تعديل الوحدة بنجاح','success');
        return redirect(route('units.index',['item_id'=>$unit->item_id]));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:: Unit delete validation
        if (BillDetail::where('unit_id',$id)->count() > 0){
            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة لهذه الوحدة ','danger');
            return back();
        }
        $unit= Unit::findOrFail($id);
        activity()->withProperties([$unit])
            ->log( 'حذف وحدة');
        $unit->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }


    public function forSalesMan($id){

        $unit= Unit::findOrFail($id);

        $units = Unit::where('item_id',$unit->item_id)->where('for','sales_man');
        $units->update(['for'=>null]);

        $unit->update(['for'=>'sales_man']);

        toast('تم  بنجاح','success');
        return redirect()->back();
    }
    public function forPos($id){

        $unit= Unit::findOrFail($id);

        $units = Unit::where('item_id',$unit->item_id)->where('for','pos');
        $units->update(['for'=>null]);

        $unit->update(['for'=>'pos']);

        toast('تم  بنجاح','success');
        return redirect()->back();
    }

}
