<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','address','manager_id'];

    //1 branch do 1 ng quan ly
    public function manager(){
    	return $this->belongsTo('App\User');
    }
}
