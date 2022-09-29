<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
    public function index(Request $request)
    {
        if (!Auth::user()->can('index categories')){
            abort(401);
        }
        //return Category::all();
        $categories = Category::where('upper_id',null)->get();

        if ($request->has('upper_id')){
            $categories = Category::where('upper_id',$request->upper_id)->get();
        }
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!Auth::user()->can('add categories')){
            abort(401);
        }
        $category=new Category();
        return view('dashboard.categories.create',compact('category'));
    }

    /**
     * Category a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        if (!Auth::user()->can('add categories')){
            abort(401);
        }
        $requests=$request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $category = Category::create($requests);

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (!Auth::user()->can('index categories')){
            abort(401);
        }
        $category = Category::findOrFail($id);

        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (!Auth::user()->can('edit categories')){
            abort(401);
        }
        $category = Category::findOrFail($id);

        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        if (!Auth::user()->can('edit categories')){
            abort(401);
        }
        if($request->upper_id == $id){
            toast('لا يمكن اختيار هذا التصنيف','error');
            return redirect()->back();
        }
        $category = Category::find($id);
        $requests = $request->all();
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $category->fill($requests)->save();
        toast('تم التعديل بنجاح ','success');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Auth::user()->can('delete categories')){
            abort(401);
        }
        //TODO:: Category delete validation

        $category= Category::findOrFail($id);
        if ($category->items->count() >0){
            toast('عملية مرفوضة - العلامة التجارية تحتوى على اصناف ','danger');
            return back();
        }
        $category->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('categories.index'));
    }
}
