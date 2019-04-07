<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use App\Branch;
use App\User;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.branch');
    }

    //DataTable
    public function getData(){
        $branches = Branch::get();
        return Datatables::of($branches)
        ->addColumn('action', function ($branch) {
            return '<button type="button" class="btn btn-success btn-show" data-id="'.$branch->id.'">Detail</button>
            <button type="button" class="btn btn-warning btn-edit" data-id="'.$branch->id.'">Edit</button>
            <button type="button" class="btn btn-danger btn-delete" data-id="'.$branch->id.'">Delete</button>';
        })
        ->editColumn('manager_id', function($branch) {
            return $branch->manager->name;
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
    public function store(BranchRequest $request)
    {
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->manager_id = $request->manager_id;
        $branch->save();
        return $branch;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);
        $branch->manager_id = $branch->manager->name;
        return $branch;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return $branch;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        $branch = Branch::find($id)->update($request->all());
        return response()->json(['data'=>$branch]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
