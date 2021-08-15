<?php

namespace App\Repositories\Admin;

use App\Models\Product;

class ProductRepository{

    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function get(){
        return $this->product->with(['brand','category'])->get();
    }

    public function store(array $productData){
        $this->product->create($productData);
    }

    public function edit(int $id,array $editData){
        $this->product->find($id)->update($editData);
    }

    public function delete(int $id){
        $this->product->find($id)->delete();
    }
}