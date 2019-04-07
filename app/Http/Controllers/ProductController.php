<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('manager.product');
    }

    public function getData(){
        $products = Product::get();
        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$product->id.'">Detail</button>
                        <button type="button" class="btn btn-primary btn-pic" data-id="'.$product->id.'">Add pic</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$product->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$product->id.'">Delete</button>';
            })
            ->editColumn('user_id', function($product) {
                return $product->user->name;
            })
            ->editColumn('category_id', function($product) {
                return $product->category->name;
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
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->product_info = $request->product_info;
        $product->description = $request->description;
        $product->user_id = Auth::user()->id;
        $product->save();
        return $product;
    }


    //Upload images
    public function uploadImage(Request $request){
        $images = $request->file('file');
        foreach ($images as $key => $value) {
            $path = $value->storeAs('images',$images[$key]->getClientOriginalName());
            $imageUpload = Image::create([
                'product_id' => 1,
                'image' => $path,
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product->category_id = $product->category->name;
        $product->user_id = $product->user->name;
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id)->update($request->all());
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
        Product::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }

    //deleteImage
    public function deleteImage(){
        
    }
}
