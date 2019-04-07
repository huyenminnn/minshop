<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','product_code','user_id','description','category_id','slug','brand','product_info','price','discount_price'];

    // 1 nguoi tao sp
    public function user(){
    	return $this->belongsTo('App\User');
    }

    // 1 sp thuoc 1 category (1-n)
    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
