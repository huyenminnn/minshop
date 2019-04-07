<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\User;
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
                    return '<img style="width: 100px;height: 100px;" src="/storage/'.$user->avatar.'">';
            })
            
            ->rawColumns(['avatar','action'])
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
