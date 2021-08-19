<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository{

    private $cart;

    public function __construct(Cart $cart){
        $this->cart = $cart;
    }

    public function get(){
        return $this->cart->with('product')->where('user_id',auth()->user()->id)->get();
    }

    public function store(array $cartData){
        $this->cart->create($cartData);
    }
}