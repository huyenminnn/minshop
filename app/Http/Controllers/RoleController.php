<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.role');
    }

    //DataTable
    public function getData(){
        $roles = Role::get();
        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$role->id.'">Detail</button>
                        <button type="button" class="btn btn-primary btn-perms" data-id="'.$role->id.'">Permission</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$role->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$role->id.'">Delete</button>';
            })
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
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return $role;
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
    public function update(Request $request, $id)
    {
        $role = Role::find($id)->update($request->all());
        return response()->json(['data'=>$role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }

    public function getPermission($id){
        $perms = Permission::all(); //arr
        $role = Role::find($id);
        $permissions = $role->permissions;
        foreach ($perms as $per1) {
            foreach ($permissions as $per2) {
                if ($per1->id == $per2->id) {
                    $per1->check = true;
                    break;
                } else $per1->check = false;
            }
        }
        return ['perms'=>$perms,'id'=>$id];
    }

    //them/xoa permisstion khoi role
    public function changeRolePerms(Request $req, $id){
        $role = Role::find($id);
        if ($req->check == 1) {
            $role->permissions()->attach($req->id_perms);
            return ['data'=>1];
        } elseif ($req->check == 0) {
            $role->permissions()->detach($req->id_perms);
            return ['data'=>0];
        }
    }
}
