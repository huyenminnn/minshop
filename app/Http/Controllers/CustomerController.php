<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Customer;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.customer');
    }

    //DataTable
    public function getData(){
        $customers = Customer::get();
        return Datatables::of($customers)
            ->addColumn('action', function ($customer) {
                $data = '<button type="button" class="btn btn-success btn-show" data-id="'.$customer->id.'">Detail</button>';
                if (Auth::user()->can(['edit-customer', 'delete-customer'])) {
                    $data .= '<button type="button" class="btn btn-warning btn-edit" data-id="'.$customer->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$customer->id.'">Delete</button>';
                }
                return $data;
            })
            ->editColumn('avatar', function($customer) {
                if ($customer->avatar == 'none') {
                    $customer->avatar = 'avatars/default-profile.png';
                }
                return '<img style="width: 100px;height: 100px;" src="/storage/'.$customer->avatar.'" class="img img-circle" >';
            })
            ->editColumn('level', function($customer) {
                $level = ['Thành viên','Thành viên Bạc','Thành viên Vàng','Thành viên Kim cương'];
                foreach ($level as $key => $value) {
                    if ($customer->level == $key) {
                        return $value;
                    }
                }
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
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->level = 0;
        $customer->password = Hash::make('000000');
        if ($request->avatar == '') {
            $avatar = 'avatars/default-profile.png';
        } else $avatar = $request->avatar->storeAs('avatars',$request->avatar->getClientOriginalName());
        $customer->avatar = $avatar;
        $customer->save();
        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $level = ['Thành viên','Thành viên Bạc','Thành viên Vàng','Thành viên Kim cương'];
        foreach ($level as $key => $value) {
            if ($customer->level == $key) {
                $customer->level = $value;
            }
        }
        return $customer; 
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
    public function update(CustomerRequest $request, $id)
    {
        $customer=Customer::find($id);
        if ($request->avatar == 'none') {
            $customer->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'mobile'=>$request->mobile,
            ]);
        } else{
            $thumb = $request->avatar->storeAs('avatar',$request->avatar->getClientOriginalName());
            $customer->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'mobile'=>$request->mobile,
                'avatar'=>$thumb,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
