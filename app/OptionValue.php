<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = ['option_id','value'];

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
