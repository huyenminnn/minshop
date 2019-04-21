<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = ['product_id','color_id','size','quantity'];

    // 1 detail cua 1 sp
    public function product(){
    	return $this->belongsTo('App\Product');
    }

    public function size_product(){
    	return $this->belongsTo('App\OptionValue','size','id');
    }
}
