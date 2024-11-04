<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\Common;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    use Common;
    public function BrandView(){

        return view('backend.admin.brand');
    }

    public function BrandStore(Request $request){

        $request->validate(
            [
                'txtBrandName' => 'required',
                'fileBrandImage' => ($request->hdBrandId == null) ? 'required' : '',
                // Remove validation for update scenario
            ],
            [
                'fileBrandImage.required' => 'Brand Image is Required',
                'txtBrandName.required' => 'Brand Name is Required'
            ]
        );

        if($request->hdBrandId == null){

            $brand = Brand::Create([
                'brand_name' => $request->txtBrandName,
            ]);
            
            if ($request->hasFile('fileBrandImage')) {
                $file = $request->file('fileBrandImage');
                $extension = $file->getClientOriginalExtension();
                $fileName = $this->generateRandom(16) . '.' . $extension;
    
                Brand::findorfail($brand->id)->update([
                    'brand_image' => $this->fileUpload($file, 'upload/brand/' . $brand->id, $fileName)
                ]);
            }
            $notification = array(
                'message' => 'Brand Created Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);

        }else{

            $oldImage = $request->hdBrandImage;
                if ($request->hasFile('fileBrandImage')) {
                    @unlink($oldImage);
                    $files = $request->file('fileBrandImage');
                    $extensions = $files->getClientOriginalExtension();
                    $fileNames = $this->generateRandom(16) . '.' . $extensions;
                }

                Brand::findorFail($request->hdBrandId)->update([
                    'brand_name' => $request->txtBrandName,
                    'brand_image' => ($request->hasFile('fileBrandImage')) ? $this->fileUpload($request->file('fileBrandImage'), 'upload/brand/' . $request->hdBrandId, $fileNames) : $oldImage,
                   
                ]);

                $notification = array(
                    'message' => 'Brand Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
        }
    }

    public function getBrandData(){

        $brand = Brand::orderBy('id', 'ASC')
            ->get();
        return datatables()->of($brand)
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

    public function getBrandById($id){

        $brand = Brand::where('id', $id)->first();
            return response()->json([
                'brand' => $brand
            ]);

    }

    public function deleteBrand(Request $request, $id){

        $brand = Brand::findorfail($id);
        $brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert' => 'success'
        );

        return response()->json([
            'responseData' => $notification
        ]);

}
}
