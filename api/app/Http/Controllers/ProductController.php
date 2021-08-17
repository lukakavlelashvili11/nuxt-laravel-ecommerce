<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandValidation;
use App\Http\Requests\Admin\ProductValidation;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function get(){
        $products = $this->productRepository->get();
        return response()->json($products);
    }

    public function getById(Request $request){
        $product = $this->productRepository->getById($request->id);
        return response()->json($product);
    }

    public function store(ProductValidation $request){
        if($request->file()){
            $file_name_for_front = $this->storeImage($request);
            $this->productRepository->store([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'imageurl' => $file_name_for_front,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id
            ]);
        }
    }

    public function edit(BrandValidation $request){
        if($request->imageurl != $request->oldImageUrl){
            $file_name = explode('products/',$request->oldImageUrl)[1];
            if(file_exists(public_path('storage/uploads/products/'.$file_name))){
                unlink(public_path('storage/uploads/products/'.$file_name));
            }

            $file_name_for_front = $this->storeImage($request);
            $this->productRepository->edit($request->id,[
                'name' => $request->name,
                'description' => $request->description,
                'imageurl' => $file_name_for_front,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id

            ]);
        }else{
            $this->productRepository->edit($request->id,[
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id
            ]);
        }
    }

    public function delete(Request $request){
        $this->productRepository->delete($request->id);
    }

    public function storeImage($request){
        $file_name = time().'_'.$request->image->getClientOriginalName();
        $request->file('image')->storeAs('uploads/products',$file_name,'public');
        return asset('storage/uploads/products/'.$file_name);
    }
}
