<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemStore;
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

}
