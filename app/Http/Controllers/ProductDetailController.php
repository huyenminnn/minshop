<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\ProductDetailRequest;
use Illuminate\Support\Facades\Auth;
use App\ProductDetail;
use App\OptionValue;
use App\Product;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ProductDetailRequest $request)
    {
        $product = new ProductDetail();
        $product->product_id = $request->product_id;
        $product->size = $request->size;
        $product->color_id = $request->color_id;
        $product->quantity = $request->quantity;
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = ProductDetail::where('product_id',$id)->get();
        return Datatables::of($details)
            ->addColumn('action', function ($detail) {
                $data = '';
                if (Auth::user()->can(['edit-detail-product','delete-detail-product'])) {
                    $data .= '<button type="button" class="btn btn-warning btn-edit-product" data-id="'.$detail->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete-product" data-id="'.$detail->id.'">Delete</button>';
                }
                return $data;
            })
            ->editColumn('product_id', function($detail) {
                $op = Product::where('id',$detail->product_id)->get();
                return $op[0]->product_code;
            })
            ->editColumn('size', function($detail) {
                $op = OptionValue::where('id',$detail->size)->get();
                return $op[0]->value;
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = ProductDetail::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDetailRequest $request, $id)
    {
        $product = ProductDetail::find($id)->update($request->all());
        return response()->json(['data'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductDetail::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
