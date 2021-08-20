<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartValidation;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository){
        $this->cartRepository = $cartRepository;
    }

    public function get(){
        $cartItems = $this->cartRepository->get();
        return response()->json($cartItems);
    }

    public function store(CartValidation $request){
        $this->cartRepository->store([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
    }

    public function update(Request $request){
        $this->cartRepository->update($request);
    }

    public function delete(Request $request){
        $this->cartRepository->delete($request->product_id);
    }
}
