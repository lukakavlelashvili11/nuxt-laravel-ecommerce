<?php

namespace App\Http\Controllers;

use App\Repositories\BrandsRepository;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    private $brandsRepository;

    public function __construct(BrandsRepository $brandsRepository){
        $this->brandsRepository = $brandsRepository;
    }
    public function get(){
        $brands = $this->brandsRepository->get();
        return response()->json($brands);
    }
}
