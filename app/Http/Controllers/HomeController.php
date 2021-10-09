<?php

namespace App\Http\Controllers;

use App\Models\SubItem;

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
        //option(['اسم القيمة المضافة' => 14]);
        //return \Arr::crossJoin([1, 2], ['a', 'b'],['$','#']);
        //return SubItem::all();

        if (auth()->user()->type == 'admin'){

            $onLineCount = SubItem::whereRaw('amount = min_amount')->count();
            $underLineCount = SubItem::whereRaw('amount < min_amount')->count();
            return view('dashboard',compact('onLineCount','underLineCount'));

        }

        return view('dashboard-sales');

    }

}
