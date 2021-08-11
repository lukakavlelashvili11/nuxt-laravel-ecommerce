<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandValidation;
use App\Repositories\Admin\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller{

    private $brandRepository;

    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }

    public function store(BrandValidation $request){
        if($request->file()){
            $file_name = time().'_'.$request->image->getClientOriginalName();
            $request->file('image')->storeAs('uploads/brands',$file_name,'public');
            
            $file_name_for_front = asset('storage/uploads/brands/'.$file_name);
            $this->brandRepository->store([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $file_name_for_front
            ]);
        }
    }

    public function get(){
        $brands = $this->brandRepository->get();
        return response()->json($brands);
    }
}
