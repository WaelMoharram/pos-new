<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Bill;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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
    public function index(Request $request)
    {

        if (!Auth::user()->can('index client')){
            abort(401);
        }
//        return $clients = Client::check()->toSql();
        return $clients = Client::check()->get();


        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add client')){
            abort(401);
        }
        $client=new Client();
        return view('dashboard.clients.create',compact('client'));
    }

    /**
     * Client a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        if (!Auth::user()->can('add client')){
            abort(401);
        }
        $client = Client::create($request->except('users'));

        if(auth()->user()->type == 'admin' && auth()->user()->store_id == null){
            $client->users()->sync($request->users);
        }else{
            $client->users()->attach($request->users);
        }

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index client')){
            abort(401);
        }
        $client = Client::findOrFail($id);

        return view('dashboard.clients.show',compact('client'));
    }


    public function report($id)
    {
        if (!Auth::user()->can('index client')){
            abort(401);
        }
        $client = Client::findOrFail($id);
        $bills = $client->bills;

        $billsIn = $client->bills->where('type','sale_in')->where('status','saved')->sum('total');
        $billsOut = $client->bills->where('type','sale_out')->where('status','saved')->sum('total');
        $cashIn = $client->bills->where('type','cash_in')->sum('money');
        $cashOut = $client->bills->where('type','cash_out')->sum('money');

        $total =  $billsIn - $billsOut -$cashOut + $cashIn;

        return view('dashboard.clients.report',compact('client','bills','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit client')){
            abort(401);
        }
        $client = Client::findOrFail($id);

        return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        if (!Auth::user()->can('edit client')){
            abort(401);
        }
        $client = Client::find($id);
        $client->fill($request->except('users'))->save();

        if(auth()->user()->type == 'admin' && auth()->user()->store_id == null){
            $client->users()->sync($request->users);
        }else{
            $client->users()->attach($request->users);
        }
        toast('تم التعديل بنجاح ','success');
        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete client')){
            abort(401);
        }
        $client= Client::findOrFail($id);
        if ($client->bills->count() > 0){
            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','error');
            return redirect()->back();
        }
        $client->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('clients.index'));
    }
}
