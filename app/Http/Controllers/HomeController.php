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
        //return \Arr::crossJoin([1, 2], ['a', 'b'],['$','#']);
        //return SubItem::all();
        return view('dashboard');

    }

}
