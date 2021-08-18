<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    private $filterRepository;

    public function __construct(FilterRepository $filterRepository){
        $this->filterRepository = $filterRepository;
    }

    public function get(){
        $brands = Brand::all();
        $categories = Category::all();
        return response()->json([$brands,$categories]);
    }

    public function getResults(Request $request){
        $filter_result = $this->filterRepository->getResults($request);
        return response()->json($filter_result);
    }
}
