<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function get(){
        $brands = Brand::all();
        $categories = Category::all();
        return response()->json([$brands,$categories]);
    }
}
