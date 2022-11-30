<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Administration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $activities = Activity::where(function ($q) use($request){
            if ($request->has('from_date') && $request->from_date != null){
                $q->whereDate('created_at','>=',$request->from_date);
            }
            if ($request->has('to_date') && $request->to_date != null){
                $q->whereDate('created_at','<=',$request->to_date);
            }
            if ($request->has('user_id') && $request->user_id != null){
                $q->where('causer_id',$request->user_id);
            }

        })->orderByDesc('id')->simplePaginate(20);

        return view('dashboard.activities.index', compact('activities'));
    }

}
