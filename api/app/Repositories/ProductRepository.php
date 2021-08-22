<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository{

    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function get(){
        return $this->product->with(['brand','category'])->get();
    }

    public function getById(int $id){
        return $this->product->find($id);
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

    public function search(string $query){
       return $this->product->where('name','LIKE','%'.$query.'%')->get();
    }
}