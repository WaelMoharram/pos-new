<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $roles = Role::all();
        activity()
            ->log( 'عرض الادوار');
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=new Role();
        $permissions = Permission::pluck('name', 'id');

        return view('dashboard.roles.create',compact('role','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests=$request->except('permissions');
        $role = Role::create($requests);
        $role->syncPermissions($request->permissions);
        activity()->withProperties($role)
            ->log( 'اضافة دور جديد');
        toast('تم اضافة القيد بنجاح','success');
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');

        return view('dashboard.roles.show',compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');

        return view('dashboard.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->permissions;

        $requests=$request->except('permissions');

        $role = $roleOld = Role::find($id);
        $role->fill($requests)->save();
        $role->syncPermissions($request->permissions);
        activity()->withProperties(['old'=>$roleOld,'attributes'=>$role])
            ->log( 'تعديل دور');
        toast('تم التعديل بنجاح ','success');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role= Role::findOrFail($id);
        activity()->withProperties($role)
            ->log( 'حذف دور');
        $role->delete();
        toast('تم الحذف بنجاح','success');
        return redirect(route('roles.index'));
    }
}
