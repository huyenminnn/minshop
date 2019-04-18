<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.employee');
    }

    //DataTable
    public function getData(){
        $employees = Employee::get();
        return Datatables::of($employees)
            ->addColumn('action', function ($employee) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$employee->id.'">Detail</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$employee->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$employee->id.'">Delete</button>';
            })
            ->editColumn('avatar', function($employee){
                    return '<img style="width: 100px;height: 100px;" src="/storage/'.$employee->avatar.'" class="img-circle">';
            })
            ->rawColumns(['avatar','action','created_at','updated_at'])
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
    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->gender = $request->gender;
        $employee->address = $request->address;
        $employee->mobile = $request->mobile;
        $employee->branch = $request->branch;
        $employee->salary = $request->salary;
        if ($request->avatar == '') {
            $avatar = 'avatars/default-profile.png';
        } else $avatar = $request->avatar->storeAs('avatars',$request->avatar->getClientOriginalName());
        $employee->avatar = $avatar;
        $employee->save();
        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return $employee;
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
    public function update(EmployeeRequest $request, $id)
    {
        $employee=Employee::find($id);
        if ($request->avatar == 'none') {
            $employee->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'branch'=>$request->branch,
                'salary'=>$request->salary,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'mobile'=>$request->mobile,
            ]);
        } else{
            $thumb = $request->avatar->storeAs('avatars',$request->avatar->getClientOriginalName());
            $employee->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'branch'=>$request->branch,
                'salary'=>$request->salary,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'mobile'=>$request->mobile,
                'avatar'=>$thumb,
            ]);
        }
        
        return response()->json(['data'=>$employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
