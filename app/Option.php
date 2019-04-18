<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['name'];

    public function values(){
        return $this->hasMany('App\OptionValue','option_id','id');
    }
}
