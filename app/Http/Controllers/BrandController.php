<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
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
        if (!Auth::user()->can('index brands')){
            abort(401);
        }
        $brands = Brand::all();

        return view('dashboard.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!Auth::user()->can('add brands')){
            abort(401);
        }
        $brand=new Brand();
        return view('dashboard.brands.create',compact('brand'));
    }

    /**
     * Brand a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        if (!Auth::user()->can('add brands')){
            abort(401);
        }
        $requests=$request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $brand = Brand::create($requests);

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('brands.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index brands')){
            abort(401);
        }
        $brand = Brand::findOrFail($id);

        return view('dashboard.brands.show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit brands')){
            abort(401);
        }
        $brand = Brand::findOrFail($id);

        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        if (!Auth::user()->can('edit brands')){
            abort(401);
        }
        $brand = Brand::find($id);
        $requests = $request->all();
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $brand->fill($requests)->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete brands')){
            abort(401);
        }
        //TODO:: Brand delete validation
        $brand= Brand::findOrFail($id);
        if ($brand->items->count() >0){
            toast('عملية مرفوضة - العلامة التجارية تحتوى على اصناف ','danger');
            return back();
        }

        $brand->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('brands.index'));
    }
}
