<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductdetailController extends Controller
{
    public function productdetailsview($id){

        $product = Product::select('products.*','brands.brand_image','categories.category_name')
        ->join('categories', 'categories.id','products.category_id')
        ->join('brands','brands.id','products.brand_id')
        ->where('products.id', $id)->first();

        return view('frontend.product.product_details',compact('product'));
    }
}
