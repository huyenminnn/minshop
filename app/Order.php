<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_code','customer_id','customer_name','address','customer_mobile','status','note','delivery_unit','coupon_code','reason_reject','user_id','total','tax'];

    public function orderDetail(){
        return $this->hasMany('App\OrderDetail','order_id','order_code');
    }
}
