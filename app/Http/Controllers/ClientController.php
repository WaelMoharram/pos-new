<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Bill;
use App\Models\Client;

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
    public function index()
    {

        if (auth()->user()->type != 'admin'){
            $clients = Client::check()->get();
        }else{
            $clients = Client::all();
        }

        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $client = Client::create($request->all());

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
        $client = Client::findOrFail($id);

        return view('dashboard.clients.show',compact('client'));
    }


    public function report($id)
    {
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

        $client = Client::find($id);
        $client->fill($request->all())->save();
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
