<?php
namespace App\Repositories\Admin;

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
}