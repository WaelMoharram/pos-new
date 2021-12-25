<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemOptionRequest;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\ItemOptionValue;
use App\Models\Option;
use App\Models\OptionSubItem;
use App\Models\SubItem;
use Illuminate\Http\Request;

class ItemOptionValueController extends Controller
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

        $itemOptionValueCount = ItemOptionValue::where('item_option_id',$request->item_option_id)->where('value',$request->value)->count();
        if ($itemOptionValueCount >0){
            toast('القيمة موجودة من قبل','error');
            return redirect()->back();
        }
        ItemOptionValue::create($request->all());

        toast('تم اضافة القيد بنجاح','success');
        return redirect()->back();
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
        $option->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('item-options.index'));
    }


    public function finalSubmit($id){
        $forSort=[];
        $item = Item::find($id);
        if ($item->is_final_options == 1){
            toast('تم اعتماد اختيارات الصنف من قبل ','error');
            return redirect()->back();
        }
        $itemOptions = ItemOption::where('item_id',$id)->get();
        $options = $itemOptions->pluck('option_id');
        foreach ($itemOptions as $one){
            array_push($forSort, $one->itemOptionValues);
        }


        $count = count($forSort);
        $subItemsNames = '';
        switch ($count) {
            case 1:
                $final = \Arr::crossJoin($forSort[0]);
                break;
            case 2:
                $final = \Arr::crossJoin($forSort[0],$forSort[1]);
                break;
            case 3:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2]);
                break;
            case 4:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2],$forSort[3]);
                break;
            case 5:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2],$forSort[3],$forSort[4]);
                break;
        }
        foreach ($final as $f){

            $name='';
            $optionId ='';
            $subItem = SubItem::create([
                'amount'=>0, 'barcode'=>'', 'note'=>'', 'item_id'=>$id, 'price'=>$item->price ,'buy_price'=>$item->buy_price
            ]);

            foreach ($f as $fi){
                $optionId = ItemOption::find($fi->item_option_id)->option_id;
                OptionSubItem::create([
                    'sub_item_id'=>$subItem->id,
                    'option_id'=>$optionId,
                    'option_value'=>$fi->value
                ]);
            }
            $item->update(['is_final_options'=>1]);

        }
        toast('تم اعتماد اختيارات الصنف بنجاح ','success');
        return redirect(route('items.index'));
    }

    public function finalSubmit2($id){
        $forSort=[];
        $item = Item::find($id);
        if ($item->is_final_options == 1){
            toast('تم اعتماد اختيارات الصنف من قبل ','error');
            return redirect()->back();
        }
        $itemOptions = ItemOption::where('item_id',$id)->get();
        $options = $itemOptions->pluck('option_id');
        foreach ($itemOptions as $one){
            array_push($forSort, $one->itemOptionValues);
        }


        $count = count($forSort);
        $subItemsNames = '';
        switch ($count) {
            case 1:
                $final = \Arr::crossJoin($forSort[0]);
                break;
            case 2:
                $final = \Arr::crossJoin($forSort[0],$forSort[1]);
                break;
            case 3:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2]);
                break;
            case 4:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2],$forSort[3]);
                break;
            case 5:
                $final = \Arr::crossJoin($forSort[0],$forSort[1],$forSort[2],$forSort[3],$forSort[4]);
                break;
        }
        foreach ($final as $f){

            $name='';
            $optionId ='';
            $subItem = SubItem::create([
                'amount'=>0, 'barcode'=>'', 'note'=>'', 'item_id'=>$id, 'price'=>$item->price ,'buy_price'=>$item->buy_price
            ]);

            foreach ($f as $fi){
                $optionId = ItemOption::find($fi->item_option_id)->option_id;
                OptionSubItem::create([
                    'sub_item_id'=>$subItem->id,
                    'option_id'=>$optionId,
                    'option_value'=>$fi->value
                ]);
            }
            $item->update(['is_final_options'=>1]);

        }
        toast('تم اعتماد اختيارات الصنف بنجاح ','success');
        return redirect(route('items.index'));
    }

}
