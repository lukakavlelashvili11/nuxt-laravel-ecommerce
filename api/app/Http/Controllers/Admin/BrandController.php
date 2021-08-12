<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandValidation;
use App\Repositories\Admin\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller{

    private $brandRepository;

    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }

    public function get(){
        $brands = $this->brandRepository->get();
        return response()->json($brands);
    }

    public function store(BrandValidation $request){
        if($request->file()){
            $file_name_for_front = $this->storeImage($request);
            $this->brandRepository->store([
                'name' => $request->name,
                'description' => $request->description,
                'imageurl' => $file_name_for_front
            ]);
        }
    }

    public function edit(BrandValidation $request){
        if($request->imageurl != $request->oldImageUrl){
            $file_name = explode('brands/',$request->oldImageUrl)[1];
            if(file_exists(public_path('storage/uploads/brands/'.$file_name))){
                unlink(public_path('storage/uploads/brands/'.$file_name));
            }

            $file_name_for_front = $this->storeImage($request);
            $this->brandRepository->edit($request->id,[
                'name' => $request->name,
                'description' => $request->description,
                'imageurl' => $file_name_for_front
            ]);
        }else{
            $this->brandRepository->edit($request->id,[
                'name' => $request->name,
                'description' => $request->description
            ]);
        }
    }

    public function delete(Request $request){
        $this->brandRepository->delete($request->id);
    }

    public function storeImage($request){
        $file_name = time().'_'.$request->image->getClientOriginalName();
        $request->file('image')->storeAs('uploads/brands',$file_name,'public');
        return asset('storage/uploads/brands/'.$file_name);
    }
}
