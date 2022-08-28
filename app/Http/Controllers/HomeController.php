<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
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
    public function index()
    {

        foreach (Item::all() as $item){
            $units = Unit::where('item_id',$item->id)->get();
            if (count($units) == 0){
                Unit::create([
                    'item_id'=>$item->id,
                    'price'=>$item->price,
                    'name'=>'الوحدة الكبرى'
                ]);
            }
        }


        //option(['اسم القيمة المضافة' => 14]);
        //return \Arr::crossJoin([1, 2], ['a', 'b'],['$','#']);
        //return SubItem::all();
        //Role::create(['name' => 'admin']);
        //Role::create(['name' => 'sales']);
        if (auth()->user()->type == 'admin'){

            $onLineCount = Item::whereRaw('amount = min_amount')->count();
            $underLineCount = Item::whereRaw('amount < min_amount')->count();
            return view('dashboard',compact('onLineCount','underLineCount'));

        }

        return view('dashboard-sales');

    }

    public function items(Request $request){
        $items=null;
           if ($request->type == 'same'){
               $items = Item::whereRaw('amount = min_amount')->get();
           }
            if ($request->type == 'under'){
                $items = Item::whereRaw('amount < min_amount')->get();
            }

        return view('items',compact('items'));

    }

}
