<?php
namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandRepository{

    private $brand;

    public function __construct(Brand $brand){
        $this->brand = $brand;
    }

    public function get(Request $request){
        return $this->brand
        ->when(!!$request->product, function($q){
            $q->with('product');
        })
        ->get();
    }

    public function getById(Request $request){
        return $this->brand
        ->when(!!$request->product, function($q){
            $q->with('product');
        })
        ->find($request->id);
        
    }

    public function store(array $brandInfo){
        $this->brand->create($brandInfo);
    }

    public function edit(int $id,array $editData){
        $this->brand->find($id)->update($editData);
    }

    public function delete(int $id){
        $this->brand->find($id)->delete();
    }
}