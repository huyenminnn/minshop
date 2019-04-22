<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Product;
use App\ProductDetail;
use App\Employee;
use App\Customer;
use App\OrderDetail;
use App\Order;
use Carbon\Carbon;


class DashboardController extends Controller
{
	public function index(){
		$employees = Employee::select(DB::raw('count(*)'))->get();
		$customers = Customer::select(DB::raw('count(*)'))->get();
		$products = Product::select(DB::raw('count(*)'))->get();
		$orders = Order::select(DB::raw('count(*)'))->where('status', '=', 'delivered')->get();
		$product_sold = OrderDetail::sum('quantity');
		$revenue = Order::sum('total');
		return view('manager.dashboard',['employees'=>$employees[0]['count(*)'],'customers'=>$customers[0]['count(*)'],'products'=>$products[0]['count(*)'],'orders'=>$orders[0]['count(*)'],'product_sold'=>number_format($product_sold), 'revenue'=>number_format($revenue)]);
	}

	public function getTime(Request $req){
		$start = Carbon::parse($req->start);
		$end = Carbon::parse($req->end);
		// $orders = Order::join('order_details','orders.order_code','=','order_details.order_id')
		// 	->groupBy('product_id')
		// 	->select('*',DB::raw('SUM(quantity) as total_products'))
		// 	->where([
		// 		['orders.status', '=', 'notconfirmed'],
		// 		['orders.updated_at', '>', $start],
		// 		['orders.updated_at', '<', $end],
		// 	])
			
		// 	->orderBy('total_products','desc')
		// 	->get();
		$orders = OrderDetail::where([
				['updated_at', '>', $start],
				['updated_at', '<', $end],
			])->get();
		$products = array();
		foreach ($orders as $key => $value) {
			// if (!in_array($value->product_id, $products) ) {
			// 	$product = $value->product_id;
			// 	$quantity = $value->quantity;
			// 	$products[]=$product;
			// 	$quantitys[] = $quantity;
			// } else {
			// 	foreach ($products as $keyp => $valuep) {
			// 		if ($valuep == $value->product_id) {
			// 			$quantitys[$keyp] += $value->quantity;
			// 			break;
			// 		}
			// 	}
			// }
			$i = 0;
			foreach ($products as $keyp => $valuep) {			
				if ($value->product_id == $valuep['id']) {
					$products[$keyp]['quantity'] += $value->quantity;
					$i = 1;
				} 
			}
			if ($i == 0) {
				$product=array();
				$product['id'] = $value->product_id;
				$product['quantity'] = $value->quantity;  
				$products[] = $product;
			}

		}

		
		
		usort($products,array($this,'cmp'));
		foreach ($products as $key => $value) {
			$product = Product::find($value['id']);
			$products[$key]['product'] = $product;
		}
		return $products;
	}

	private static function cmp($a, $b){
		    if ($a["quantity"] == $b["quantity"]) {
		        return 0;
		    }
		    return ($a["quantity"] > $b["quantity"]) ? -1 : 1;
		}
}
