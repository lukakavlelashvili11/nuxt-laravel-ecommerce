<?php
namespace App\Repositories\Admin;

use App\Models\Brand;

class BrandRepository{

    private $brand;

    public function __construct(Brand $brand){
        $this->brand = $brand;
    }

    public function store(array $brandInfo){
        $this->brand->create($brandInfo);
    }

    public function edit(int $id,array $editData){
        $this->brand->find($id)->update($editData);
    }

    public function get(){
        return $this->brand->all();
    }

    public function delete(int $id){
        $this->brand->find($id)->delete();
    }
}