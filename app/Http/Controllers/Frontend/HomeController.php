<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeView(){

        $categorys = Category::get();
        $brands = Brand::get();
        $categories3 = Category::take(3)->get();
        $products = Product::select('products.*','categories.category_name','brands.brand_name')
        ->join('categories', 'categories.id','products.category_id')
        ->join('brands','brands.id','products.brand_id')
        ->orderBy('id', 'ASC');
        return view('frontend.home',compact('categorys','brands','products','categories3'));
    }
}
