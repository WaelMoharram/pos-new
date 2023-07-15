<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Imports\ItemsImport;
use App\Imports\NewItemsImport;
use App\Models\Bill;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//       $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (!Auth::user()->can('index items')){
            abort(401);
        }
        $items = Item::where(function($q){
            if (request()->has('name') && request()->name != null){
                $q->where('name','like','%'.request()->name.'%');
            }
            if (request()->has('barcode') && request()->barcode != null){
                $q->where('barcode','like','%'.request()->barcode.'%');
            }
        })->orderBy('name')->paginate(15);
        activity()
            ->log( 'عرض الاصناف');


        return view('dashboard.items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add items')){
            abort(401);
        }
        $item=new Item();
        return view('dashboard.items.create',compact('item'));
    }

    /**
     * Item a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        if (!Auth::user()->can('add items')){
            abort(401);
        }
        $requests=$request->all();
        $requests['code'] = strtotime(date('Y-m-d'));
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }

        $item = Item::create($requests);
        $item->code = $item->id;
        $item->save();
        Unit::create([
                    'item_id'=>$item->id,
                    'price'=>$item->price,
                    'name'=>'الوحدة الكبرى'
                ]);
        activity()->withProperties($item)
            ->log( 'اضافة صنف جديد');
        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index items')){
            abort(401);
        }
        $item = Item::findOrFail($id);

        return view('dashboard.items.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit items')){
            abort(401);
        }
        $item = Item::findOrFail($id);

        return view('dashboard.items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        if (!Auth::user()->can('edit items')){
            abort(401);
        }
        $item = $itemOld = Item::find($id);

        $unit = Unit::where('item_id',$id)->where('ratio',1)->first();
        $unit->update(['price'=>$request->price]);
        $requests = $request->all();
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }

        $item->fill($requests)->save();
        activity()->withProperties(['old'=>$itemOld,'attributes'=>$item])
            ->log( 'تعديل صنف ');
        toast('تم التعديل بنجاح ','success');
        return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete items')){
            abort(401);
        }
        //TODO:: Item delete validation
        $item= Item::findOrFail($id);
        if ($item->Billsdetails->count() >0){
            toast('عملية مرفوضة - الصنف موجود فى فاتورة ','danger');
            return back();
        }
        activity()->withProperties($item)
            ->log( 'حذف صنف');
        $item->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('items.index'));
    }

    public function import()
    {
        Excel::import(new NewItemsImport(), request()->file('file'));
        //toast('تمت الاضافة بنجاح','success');
        return 'done';
    }

    public function barcode(Request $request){
        if (Item::where('barcode',$request->barcode)->first()){
            $id = Item::where('barcode',$request->barcode)->first()->id;
            $units = Unit::where('item_id',$id)->get();
            return ['id'=>$id,'units'=>$units];
            return (int)$id;
        }
        return  null;
    }
    public function unitsForItem(Request $request){
        if (Item::where('id',$request->id)->first()){
            $id = $request->id;
            $units = Unit::where('item_id',$id)->get();
            return ['id'=>$id,'units'=>$units];
            return (int)$id;
        }
        return  [];
    }

    public function printBarcode(Request $request){
        $item = Item::find($request->item_id);
        $quantity = $request->quantity ?? 1;
        activity()->withProperties($item)
            ->log( 'طباعة باركود صنف');
        return view('dashboard.items.print-barcode',compact('item','quantity'));
    }
}
