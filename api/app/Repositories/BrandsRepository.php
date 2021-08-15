<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandsRepository{

    private $brand;

    public function __construct(Brand $brand){
        $this->brand = $brand;
    }

    public function get(){
        return $this->brand->with('product')->get();
    }

}