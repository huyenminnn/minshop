<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        return view('manager.order',['type'=>$type]);
    }

    public function getData($type){
        $orders = Order::where('status',$type)->get();

        if ($type == 'confirmed') {
            return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return '<button type="button" class="btn btn-warning btn-deli" data-id="'.$order->id.'">Delivery</button>
                        <button type="button" class="btn btn-success btn-show" data-id="'.$order->id.'">Detail</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$order->id.'">Delete</button>';
            })->make(true);
        } elseif ($type == 'notconfirmed') {
            return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return '<button type="button" class="btn btn-warning btn-conf" data-id="'.$order->id.'">Confirm it</button>
                        <button type="button" class="btn btn-success btn-show" data-id="'.$order->id.'">Detail</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$order->id.'">Delete</button>';
            })->make(true);
        } else {
            return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$order->id.'">Detail</button>
                    <button type="button" class="btn btn-danger btn-delete" data-id="'.$order->id.'">Delete</button>';
            })->make(true);
        } 
        
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

    //new order Online
    public function orderOnline(){
        
    }
}
