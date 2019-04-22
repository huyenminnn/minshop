<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id','quantity','product_id','product_detail_id','total'];

    public function order(){
    	return $this->belongsTo('App\Order','order_id','order_code');
    }
}
