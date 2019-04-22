<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;
use App\Order;
use Carbon\Carbon;
use Cart;
use App\OrderDetail;
use App\ProductDetail;
use App\Product;

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
        } elseif ($type == 'completed') {
            return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return '<button type="button" class="btn btn-warning btn-completed" data-id="'.$order->id.'">Completed</button>
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
     * Remove the specified resour ce from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmOrder($id){
        $order = Order::find($id);
        $order->update([
            'status'=>'confirmed',
        ]);
        return $order;
    }

    public function deliveryOrder($id){
        $order = Order::find($id);
        $order->update([
            'status'=>'delivering',
        ]);
        return $order;
    }

    public function deleteOrder(Request $req, $id){
        $order = Order::find($id);
        $order->update([
            'status'=>'canceled',
            'reason_reject'=>$req->reason,
        ]);
        return $order;
    }

    public function completed($id){
        $order = Order::find($id);
        $order->update([
            'status'=>'completed',
        ]);
        return $order;
    }

    //new order Online
    public function orderOnline(OrderRequest $request){
        $order = new Order();
        $order->order_code = 'online'.time().$request->customer_id;
        $order->customer_id = $request->customer_id;
        $order->customer_name = $request->customer_name;
        $order->customer_mobile = $request->customer_mobile;
        $order->address = $request->address;
        $order->note = $request->note;
        $order->status = 'notconfirmed';
        $order->delivery_unit = $request->delivery_unit;
        $order->tax = floatval(str_replace(",","",Cart::tax()));
        $order->total = floatval(str_replace(",","",Cart::total()));
        $order->save();

        foreach (Cart::content() as $key => $value) {
            $product = Cart::get($key);
            $productDetail = ProductDetail::find($product->id);
            $quantity = $productDetail->quantity - $product->qty;
            $productDetail->update([
                'quantity' => $quantity,
            ]);
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->order_code;
            $orderDetail->product_id = $product->options->product_id;
            $orderDetail->product_detail_id = $product->id;
            $orderDetail->quantity = $product->qty;
            $orderDetail->total = $product->qty*$product->price;
            $orderDetail->save();
        }
        Cart::destroy();
        return redirect('/history');
    }

    public function historyView(){
        $customer = Auth::guard('customer')->id();
        $orders = Order::where('customer_id',$customer)->get();
        $notconfirmed = array();
        $confirmed = array();
        $delivering = array();
        $complete = array();
        foreach ($orders as $key => $value) {
            if ($value->status == 'notconfirmed') {
                $notconfirmed[] = $value;
            } elseif ($value->status == 'confirmed') {
                $confirmed[] = $value;
            } elseif ($value->status == 'delivering') {
                $delivering[] = $value;
            } else{
                $complete[] = $value;
            }
        }
        return view('sale.history',['notconfirmed'=>$notconfirmed,'confirmed'=>$confirmed, 'delivering'=>$delivering,'complete'=>$complete]);
    }

    public function detailOrder($id){
        $order = Order::find($id);
        $detail = $order->orderDetail;
        foreach ($detail as $key => $value) {
            $product = Product::find($value->product_id);
            $productDetail = ProductDetail::find($value->product_detail_id);
            $value->img = $product->thumbnail;
            $value->size = $productDetail->size_product->value;
            $value->color = $productDetail->color_id;
            $value->name = $product->name;
            $value->price = number_format($product->price);
            $value->total = number_format($value->total);
        }
        return $detail;
    }
}
