<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Http\Request;

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

    public function update(Request $request){
        $this->cart
        ->where([
            ['user_id',auth()->user()->id],
            ['product_id',$request->product_id]
        ])
        ->update(
            ['quantity' => $request->quantity]
        );
    }

    public function delete(int $product_id){
        $this->cart
        ->where([
            ['user_id',auth()->user()->id],
            ['product_id',$product_id]
        ])
        ->delete();
    }
}