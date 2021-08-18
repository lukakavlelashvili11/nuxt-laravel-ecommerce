<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterRepository{
    private $brand;
    private $category;
    private $product;

    public function __construct(Brand $brand,Category $category,Product $product){
        $this->brand = $brand;
        $this->category = $category;
        $this->product = $product;
    }

    public function getResults(Request $request){
        return $this->product
        ->when(!!$request->brands,function($q) use ($request){
            $q->whereIn('brand_id',$request->brands);
        })
        ->when(!!$request->categories,function($q) use ($request){
            $q->whereIn('category_id',$request->categories);
        })
        ->when(!!$request->price,function($q) use ($request){
            $q->whereBetween('price',$request->price);
        })
        ->get();
    }
}