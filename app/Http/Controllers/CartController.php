<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;


class CartController extends Controller
{
    public function add(){
    	Cart::add('293ad', 'Product 1', 1, 9.99, ['size' => 'large']);
    	dd(Cart::content());
    }
}
