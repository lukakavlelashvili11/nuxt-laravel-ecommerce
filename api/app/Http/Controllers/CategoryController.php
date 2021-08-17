<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidation;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function store(CategoryValidation $request){
        $this->categoryRepository->store([
            'name' => $request->name
        ]);
    }

    public function get(){
        $categories = $this->categoryRepository->get();
        return response()->json($categories);
    }

    public function delete(Request $request){
        $this->categoryRepository->delete($request->id);
    }

    public function edit(CategoryValidation $request){
        $this->categoryRepository->edit($request->id,['name' => $request->name]);
    }
}