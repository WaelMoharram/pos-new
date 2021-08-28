<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::where('type','admin')->paginate(10);
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=new User();
        return view('dashboard.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests=$request->all();
        $requests['type']='admin';
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $requests['password']=Hash::make($request->password);
        $user = User::create($requests);

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.users.index'));
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

        return view('dashboard.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.users.edit',compact('user'));
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
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.users.index'));
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
            toast(__('Can not delete yourself'),'danger');
            return back();
        }
        $user= User::findOrFail($id);
        $user->delete();
        toast(__('Deleted successfully'),'success');
        return redirect(route('dashboard.users.index'));
    }
}
