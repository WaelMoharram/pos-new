<?php

namespace App\Http\Controllers;

//use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemStore;
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
        $items = Item::all()->sortByDesc('report_amount');
        return view('dashboard.reports.items', compact('items'));
    }

}
