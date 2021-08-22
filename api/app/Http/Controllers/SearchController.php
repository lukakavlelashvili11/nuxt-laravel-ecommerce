<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function get(Request $request){
        $result = $this->productRepository->search($request->q);
        return response()->json($result);
    }
}
