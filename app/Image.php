<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['product_id','image'];

    // 1 nguoi tao sp
    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
