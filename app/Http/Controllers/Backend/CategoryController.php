<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use Common;
    public function CategoryView(){

        return view('backend.admin.category');
    }

    public function CategoryStore(Request $request){

        $request->validate(
            [
                'txtCategoryName' => 'required',
                'fileCategoryImage' => ($request->hdCategoryId == null) ? 'required' : '',
                // Remove validation for update scenario
            ],
            [
                'fileCategoryImage.required' => 'Category Image is Required',
                'txtCategoryName.required' => 'Category Name is Required'
            ]
        );

        if($request->hdCategoryId == null){

            $category = Category::Create([
                'category_name' => $request->txtCategoryName,
            ]);
            
            if ($request->hasFile('fileCategoryImage')) {
                $file = $request->file('fileCategoryImage');
                $extension = $file->getClientOriginalExtension();
                $fileName = $this->generateRandom(16) . '.' . $extension;
    
                Category::findorfail($category->id)->update([
                    'category_image' => $this->fileUpload($file, 'upload/category/' . $category->id, $fileName)
                ]);
            }
            $notification = array(
                'message' => 'Category Created Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);

        }else{

            $oldImage = $request->hdCategoryImage;
                if ($request->hasFile('fileCategoryImage')) {
                    @unlink($oldImage);
                    $files = $request->file('fileCategoryImage');
                    $extensions = $files->getClientOriginalExtension();
                    $fileNames = $this->generateRandom(16) . '.' . $extensions;
                }

                Category::findorFail($request->hdCategoryId)->update([
                    'category_name' => $request->txtCategoryName,
                    'category_image' => ($request->hasFile('fileCategoryImage')) ? $this->fileUpload($request->file('fileCategoryImage'), 'upload/category/' . $request->hdCategoryId, $fileNames) : $oldImage,
                   
                ]);

                $notification = array(
                    'message' => 'Category Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
        }


    }

    public function getCategoryData(){

        $category = Category::orderBy('id', 'ASC')
            ->get();
        return datatables()->of($category)
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

    public function getCategoryById($id){

        $category = Category::where('id', $id)->first();
            return response()->json([
                'category' => $category
            ]);

    }

    public function deleteCategory(Request $request, $id){

            $category = Category::findorfail($id);
            $category->delete();

            $notification = array(
                'message' => 'Category Deleted Successfully',
                'alert' => 'success'
            );

            return response()->json([
                'responseData' => $notification
            ]);

    }
}
