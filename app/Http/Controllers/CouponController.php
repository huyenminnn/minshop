<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.coupon');
    }


    //DataTable
    public function getData(){
        $coupons = Coupon::get();
        return Datatables::of($coupons)
        ->addColumn('action', function ($coupon) {
            return '<button type="button" class="btn btn-success btn-show" data-id="'.$coupon->id.'">Detail</button>
            <button type="button" class="btn btn-warning btn-edit" data-id="'.$coupon->id.'">Edit</button>
            <button type="button" class="btn btn-danger btn-delete" data-id="'.$coupon->id.'">Delete</button>';
        })
        ->editColumn('percent', function($coupon) {
                    return '-'.$coupon->percent.'%';
        })  
        ->editColumn('money', function($coupon) {
                    return '-'.$coupon->money.' VND';
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
    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->start_time = Carbon::parse($request->start_time);
        $coupon->end_time = Carbon::parse($request->end_time);
        $coupon->money = $request->money;
        $coupon->percent = $request->percent;
        $coupon->save();
        return $coupon;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::find($id);
        return $coupon;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $coupon=Coupon::find($id);
        
        $coupon->update([
            'name'=>$request->name,
            'start_time'=>Carbon::parse($request->start_time),
            'end_time'=>Carbon::parse($request->end_time),
            'code'=>$request->code,
            'money'=>$request->money,
            'percent'=>$request->percent,
        ]);
        return response()->json(['data'=>$coupon]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
