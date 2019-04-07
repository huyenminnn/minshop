<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','parent_id','description'];

    //1 catagory có nhieu sp
    public function product(){
        return $this->hasMany('App\Product','category_id','id');
    }
}
