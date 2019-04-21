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
    // public function __construct(){
    //     $this->middleware('role:super_admin')->only('create');
    // }

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
                $data = '<button type="button" class="btn btn-success btn-show" data-id="'.$product->id.'">Detail</button>';
                if (Auth::user()->can(['edit-product', 'delete-product'])) {
                    $data .= '<button type="button" class="btn btn-primary btn-pic" data-id="'.$product->id.'">Add pic</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$product->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$product->id.'">Delete</button>';
                }
                return $data;
            })
            ->editColumn('thumbnail', function($product) {
                    return '<img style="width: 100px;height: 100px;" src="/storage/'.$product->thumbnail.'" class="img-thumbnail">';
            })
            ->editColumn('user_id', function($product) {
                return $product->user->name;
            })
            ->editColumn('category_id', function($product) {
                return $product->category->name;
            })
            ->editColumn('price', function($product) {
                return number_format($product->price);
            })
            ->editColumn('discount_price', function($product) {
                return number_format($product->discount_price);
            })
            ->rawColumns(['thumbnail','action','created_at'])
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
        $product->discount_price = $request->discount_price;
        $product->product_info = $request->product_info;
        $product->description = $request->description;
        $product->user_id = Auth::user()->id;
        if ($request->thumbnail == '') {
            $thumbnail = 'images/default-thumbnail.jpg';
        } else $thumbnail = $request->thumbnail->storeAs('images',$request->thumbnail->getClientOriginalName());
        $product->thumbnail = $thumbnail;
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
        $product = Product::find($id);
        if ($request->thumbnail == 'none') {
            $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'product_code' => $request->product_code,
                'brand' => $request->brand,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'product_info' => $request->product_info,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);
        } else{
            $thumb = $request->thumbnail->storeAs('images',$request->thumbnail->getClientOriginalName());
            $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'product_code' => $request->product_code,
                'brand' => $request->brand,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'product_info' => $request->product_info,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'thumbnail'=>$thumb,
            ]);
        }
        return $product;
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

    public function showInfoProduct($id){
         $product = Product::where('slug',$id)->get();
         return view('sale.info',['product'=>'product']);
    }
}
