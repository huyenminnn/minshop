<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.user');
    }

    //DataTable
    public function getData(){
        $users = User::get();
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$user->id.'">Detail</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$user->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$user->id.'">Delete</button>';
            })
            ->editColumn('avatar', function($user) {
                    return '<img style="width: 100px;height: 100px;" src="/storage/'.$user->avatar.'" class="img-circle">';
            })
            ->editColumn('created_at', function($user){
                    return $user->created_at->format('H:i:s | d/m/Y');
            })
            ->editColumn('role', function($user) {
                    $roles = $user->roles;
                    $data = '';
                    foreach ($roles as $key => $value) {
                        $data = $value->display_name;
                    }
                    return $data;
            })
            ->rawColumns(['avatar','action','role','created_at'])
            ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {   
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        
        $user->password = Hash::make('000000');
        if ($request->avatar == '') {
            $avatar = 'avatars/default-profile.png';
        } else $avatar = $request->avatar->storeAs('avatars',$request->avatar->getClientOriginalName());
        $user->avatar = $avatar;
        $user->save();

        $role = Role::find($request->role);
        $newUser = User::where('email',$request->email)->first();
        $newUser->attachRole($role);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->created = $user->created_at->format('H:i:s | d/m/Y');
        $user->updated = $user->updated_at->format('H:i:s | d/m/Y');

        $role = $user->roles->first();
        $user->role = $role->id;
        
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user=User::find($id);
        if ($request->avatar == 'none') {
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        } else{
            $thumb = $request->avatar->storeAs('avatar',$request->avatar->getClientOriginalName());
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'avatar'=>$thumb,
            ]);
        }
        // $user->roles()->updateExistingPivot($request->role, ['role_id'=>$request->role]);
        
        DB::table('role_user')
            ->where('user_id', $user->id)
            ->update(['role_id' => $request->role]);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
