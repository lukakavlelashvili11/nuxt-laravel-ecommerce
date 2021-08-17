<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository{
    
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function store(array $categoryInfo){
        $this->category->create($categoryInfo);
    }

    public function get(){
        return $this->category->all();
    }

    public function delete(int $id){
        $this->category->find($id)->delete();
    }

    public function edit(int $id,array $editData){
        $this->category->find($id)->update($editData);
    }
}