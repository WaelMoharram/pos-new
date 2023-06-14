<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemStore;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
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
     * Show Items Report.
     * @param Request $request
     * @return void
     */
    public function items(Request $request){
        $items = Item::all();
        if ($request->has('sort_by') && $request->sort_by == 'report_amount'){
            $items = $items->sortBy('report_amount');
        }else{
            $items = $items->sortByDesc('report_amount');
        }

        if ($request->has('number')){
            if ($request->number != 'all'){
                $items = $items->take($request->number);
            }
        }else{
            $items = $items->take(5);
        }
        return view('dashboard.reports.items', compact('items'));
    }

    public function salesMen(Request $request){
        $salesMen = User::where('store_id','!=',null)->get();
        return view('dashboard.reports.sales-men', compact('salesMen'));
    }

    public function quantityInDate(){
        $items = Item::paginate(20);
        return view('dashboard.reports.quantity-in-date', compact('items'));
    }
    public function itemCard($id){
        $item = Item::find($id);
        $details = BillDetail::whereHas('bill')->where('item_id',$id)->get();
        return view('dashboard.reports.item-card', compact('item','details'));
    }
    public function storeCard($id){
        $store = Store::find($id);

        $details = BillDetail::whereHas('bill',function ($q) use ($id){
            $q->where('store_id',$id)->orWhere('store_from_id',$id)->orWhere('store_to_id',$id);
        })->get();
        return view('dashboard.reports.store-card', compact('store','details'));
    }

}
