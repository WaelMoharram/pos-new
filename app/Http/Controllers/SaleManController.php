<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManRequest;
use App\Http\Requests\UserRequest;
use App\Models\Bill;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SaleManController extends Controller
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
        $users = User::where('type','sales')->paginate(10);

        return view('dashboard.sales-men.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::pluck('name', 'id');

        $user=new User();
        return view('dashboard.sales-men.create',compact('user','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $requests=$request->except('role');
        $requests['type']='sales';
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $requests['password']=Hash::make($request->password);
        $user = User::create($requests);
        Store::create([
            'name'=>$request->name,
            'address'=>' ',
            'sales_man_id'=>$user->id,
            'is_pos'=>1
        ]);

        $user->syncRoles($request->role);

        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('sales-men.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $role = Role::pluck('name', 'id');

        $store = $user->store;
        return view('dashboard.sales-men.show',compact('user','store','role'));
    }

    public function report($id)
    {
        $user = User::findOrFail($id);
        $payments = Bill::where('sales_man_id',$id)->whereIn('type',['cash_in','cash_out'])->orderByDesc('id')->get();
        return view('dashboard.sales-men.report',compact('user','payments'));
    }

    public function collect($id)
    {
        $user = User::findOrFail($id);
        $payments = Bill::where('sales_man_id',$id)->whereIn('type',['cash_in','cash_out'])->where('money_collected',0);
        $payments->update(['money_collected'=>1,'collected_at'=>date('Y-m-d H:i:s')]);
        return  redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::pluck('name', 'id');

        $user = User::findOrFail($id);

        return view('dashboard.sales-men.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $requests=$request->except('role');
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        if(!is_null($request->password)){
            $requests['password']=Hash::make($request->password);
        }else{
            unset($requests['password']);
        }
        $user = User::find($id);
        $user->fill($requests)->save();
        $user->syncRoles($request->role);

        toast('تم التعديل بنجاح ','success');
        return redirect(route('sales-men.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::id()){
            toast('غير مسموح بحذف بياناتك ','danger');
            return back();
        }
        if (Auth::user()->bills->count() > 0){
            toast('غير مسموح بحذف بياناتك ','danger');
            return back();
        }
        $user= User::findOrFail($id);
        $user->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('sales-men.index'));
    }
}
