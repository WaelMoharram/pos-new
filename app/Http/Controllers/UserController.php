<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        if (!Auth::user()->can('index users')){
            abort(401);
        }
        $users = User::where('type','admin')->paginate(10);
        activity()
            ->log( 'عرض المستخدمين');
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('add users')){
            abort(401);
        }
        $user=new User();
        $role = Role::pluck('name', 'id');

        return view('dashboard.users.create',compact('user','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (!Auth::user()->can('add users')){
            abort(401);
        }
        $requests=$request->except('role');
        $requests['type']='admin';
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $requests['password']=Hash::make($request->password);
        $user = User::create($requests);
        $user->syncRoles($request->role);
        $logUser = $user;
        $logUser['roles'] = Role::find($request->role)->name;
        activity()->withProperties($logUser)
            ->log( 'اضافة مستخدم جديد');
        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('index users')){
            abort(401);
        }
        $user = User::findOrFail($id);
        $role = Role::pluck('name', 'id');

        return view('dashboard.users.show',compact('user','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('edit users')){
            abort(401);
        }
        $user = User::findOrFail($id);
        $role = Role::pluck('name', 'id');

        return view('dashboard.users.edit',compact('user','role'));
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
        //return $request->permissions;
        if (!Auth::user()->can('edit users')){
            abort(401);
        }
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
        $user = $oldUser= User::find($id);
        $user->fill($requests)->save();
        $user->syncRoles($request->role);
        $logUser = $user;
        $logUser['roles'] = Role::find($request->role)->name;
        activity()->withProperties(['old'=>$oldUser,'attributes'=>$logUser])
            ->log( 'تعديل مستخدم');
        toast('تم التعديل بنجاح ','success');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete users')){
            abort(401);
        }
        if ($id == Auth::id()){
            toast('غير مسموح بحذف بياناتك ','danger');
            return back();
        }
        $user= User::findOrFail($id);
        activity()->withProperties([$user])
            ->log( 'حذف مستخدم');
        $user->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('users.index'));
    }
}
