<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
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
    public function index()
    {
        if (!Auth::user()->can('index options')){
            abort(401);
        }
        $options = Option::all();

        return view('dashboard.options.index',compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add options')){
            abort(401);
        }
        $option=new Option();
        return view('dashboard.options.create',compact('option'));
    }

    /**
     * Option a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        if (!Auth::user()->can('add options')){
            abort(401);
        }
        $requests=$request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $option = Option::create($requests);

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('options.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index options')){
            abort(401);
        }
        $option = Option::findOrFail($id);

        return view('dashboard.options.show',compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit options')){
            abort(401);
        }
        $option = Option::findOrFail($id);

        return view('dashboard.options.edit',compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id)
    {
        if (!Auth::user()->can('edit options')){
            abort(401);
        }
        $option = Option::find($id);
        $requests = $request->all();
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $option->fill($requests)->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('options.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete options')){
            abort(401);
        }
        //TODO:: Option delete validation
//        if (){
//            toast('عملية مرفوضة - المخزن يحتوى على معاملات سابقة ','danger');
//            return back();
//        }
        $option= Option::findOrFail($id);
        $option->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('options.index'));
    }
}
