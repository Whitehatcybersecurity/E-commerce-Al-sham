<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Common;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Common;
    public function ProductView(){

        $category = Category::orderBy('id', 'ASC')
        ->get();
        $brand = Brand::orderBy('id', 'ASC')
                ->get();

        return view('backend.admin.products.product',compact('category','brand'));
    }

    public function ProductStore(Request $request){

        $request->validate(
            [
                'txtProductName' => 'required',
                'ddlCategory' => 'required',
                'txtProductPrice' => 'required',
                'ddlBrand' => 'required',
                'txtProductDiscount' => 'required',
                'txtShortDescription' => 'required',
                'fileProductImage' => ($request->hdProductId == null) ? 'required' : '',
                // Remove validation for update scenario
            ],
            [
                'fileProductImage.required' => 'Product Image is Required',
                'txtProductName.required' => 'Product Name is Required'
            ]
        );

        if($request->hdProductId == null){

            $product = Product::Create([
                'product_name' => $request->txtProductName,
                'category_id' => $request->ddlCategory,
                'product_price' => $request->txtProductPrice,
                'brand_id' => $request->ddlBrand,
                'discount' => $request->txtProductDiscount,
                'description' => $request->txtShortDescription,
            ]);
            
            if ($request->hasFile('fileProductImage')) {
                $file = $request->file('fileProductImage');
                $extension = $file->getClientOriginalExtension();
                $fileName = $this->generateRandom(16) . '.' . $extension;
    
                Product::findorfail($product->id)->update([
                    'product_image' => $this->fileUpload($file, 'upload/product/' . $product->id, $fileName)
                ]);
            }
            $notification = array(
                'message' => 'Product Created Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);

        }else{

            $oldImage = $request->hdProductImage;
                if ($request->hasFile('fileProductImage')) {
                    @unlink($oldImage);
                    $files = $request->file('fileProductImage');
                    $extensions = $files->getClientOriginalExtension();
                    $fileNames = $this->generateRandom(16) . '.' . $extensions;
                }

                Product::findorFail($request->hdProductId)->update([
                    'product_name' => $request->txtProductName,
                    'category_id' => $request->ddlCategory,
                    'product_price' => $request->txtProductPrice,
                    'brand_id' => $request->ddlBrand,
                    'discount' => $request->txtProductDiscount,
                    'description' => $request->txtShortDescription,
                    'product_image' => ($request->hasFile('fileProductImage')) ? $this->fileUpload($request->file('fileProductImage'), 'upload/product/' . $request->hdProductId, $fileNames) : $oldImage,
                   
                ]);

                $notification = array(
                    'message' => 'Product Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
        }


    }

    public function getProductData(){

        $product = Product::select('products.*','categories.category_name','brands.brand_name')
        ->join('categories', 'categories.id','products.category_id')
        ->join('brands','brands.id','products.brand_id')
        ->orderBy('id', 'ASC');
        return datatables()->of($product)
            ->addColumn('action', function ($row) {
                $html = "";
                // $html = '<i class="text-primary ri-pencil-line"
                // onclick="doEdit(' . $row->id . ');"></i> ';
                $html = '<button class="btn btn-success waves-effect waves-light"
                onclick="doEdit(' . $row->id . ');">Edit</button> ';
                $html .= '<button class="btn btn-danger waves-effect waves-light" id="confrim-color(' . $row->id . ')" onclick="showDelete(' . $row->id . ');">Delete</button>';
                return $html;
            })->toJson();
    }

    public function getProductById($id){

        $product = Product::where('id', $id)->first();
            return response()->json([
                'product' => $product
            ]);

    }

    public function deleteProduct(Request $request, $id){

        $product = Product::findorfail($id);
        $product->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert' => 'success'
        );

        return response()->json([
            'responseData' => $notification
        ]);

}
}
