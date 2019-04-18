<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = ['option_id','value'];

    public function option(){
    	return $this->belongsTo('App\Option');
    }
}
