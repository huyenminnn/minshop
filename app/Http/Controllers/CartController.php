<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Cart;
use App\Product;
use App\ProductDetail;
use App\Image;
use App\OptionValue;

class CartController extends Controller
{
	public function add(Request $req, $id){
		$product = Product::find($req->product_id);
		$productDetail = ProductDetail::find($id);
    	// if (!$req->quantity < $productDetail->quantity) {
    	// 	return error;
    	// } else{
    	// dd($id);
		Cart::add($productDetail->id, $product->name, $req->quantity, $product->discount_price, ['size' => $productDetail->size_product->value,'color' => $productDetail->color_id, 'product_id' => $req->product_id]);
		return Cart::content();
    	// }
	}

	public function show($id){
		$product = Product::find($id);
		$product->price = number_format($product->price);
		$productDetail = $product->productDetail;

		if (count($productDetail) == 0) {
			return ['data'=>false];
		} else {
			$sizes = array();
			$colors = array();

			foreach ($productDetail as $key => $value) {
				$size = $value->size_product;
				if (!in_array($size, $sizes)) {
					$sizes[] = $size;
				}
				$color = $value->color_id;
				if (!in_array($color, $colors)) {
					$colors[] = $color;
				}
			}
			$data =  array('product'=>$product, 'products' => $productDetail, 'sizes'=>$sizes, 'colors'=>$colors);
			return $data;
		}

	}

	public function getData(){
    	// Cart::destroy();
		$cart = Cart::content();
		$products = array();
		foreach ($cart as $key => $value) {
			$products[] = Cart::get($key);
		}
		return Datatables::of($products)
		->addColumn('action', function ($product) {
			return '<button type="button" class="btn btn-danger btn-delete" data-id="'.$product->rowId.'">Delete</button>';
		})
		->editColumn('thumbnail', function($product) { 
			$prod = Product::find($product->options->product_id);
			$data = '<img src="/storage/'.$prod->thumbnail.'" alt=" " class="img-fluid img-responsive">';
			return $data;
		})
		->editColumn('qty', function($product) { 
			$data = '<button><i class="far fa-minus-square minus"  style="font-size: 15px;" data-id="'.$product->rowId.'"></i></button> '.$product->qty.' <button><i class="far fa-plus-square plus" style="font-size: 15px;" data-id="'.$product->rowId.'"></i></button>';
			return $data;
		})
		->editColumn('price', function($product) { 
			$data = number_format($product->price);
			return $data;
		})
		->editColumn('subtotal', function($product) { 
			$data = number_format($product->subtotal);
			return $data;
		})
		->rawColumns(['qty','price','subtotal','action','thumbnail'])
		->make(true);
	}

	public function getTotal(){
		return [Cart::subtotal(),Cart::tax(),Cart::total()];
	}

	public function checkout(){
		
		if (Cart::count() == 0) {
			return redirect('/');
		} else{
			$cart = Cart::content();
			$products = array();
			foreach ($cart as $key => $value) {
				$product = Cart::get($key);
				$prod = Product::find($product->options->product_id);
				$img = $prod->thumbnail;
				$product->img = $img;
				$products[] = $product;	
			}
			return view('sale.checkout',['products'=>$products]);
		}
		
	}

	public function deleteProduct($id){
		 Cart::remove($id);
		 return [Cart::subtotal(),Cart::tax(),Cart::total()];
	}

	public function minusProduct($id){
		$product = Cart::get($id);
		if ($product->qty == 1) {
			Cart::remove($id);
			return ['data'=>true];
		} else{
			Cart::update($id, $product->qty-1);
			return [Cart::subtotal(),Cart::tax(),Cart::total()];
		} 
	}

	public function plusProduct($id){
		$product = Cart::get($id);
		$productDetail = ProductDetail::find($product->id);
		if ($product->qty == $productDetail->quantity) {
			return ['data'=>true];
		} else{
			Cart::update($id, $product->qty+1);
			return [Cart::subtotal(),Cart::tax(),Cart::total()];
		} 
	}
}
