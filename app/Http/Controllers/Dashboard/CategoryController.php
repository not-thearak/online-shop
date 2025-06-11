<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    public function index(){

        return view('back-end.category');
    }
    public function list(){

        $categories = Category::orderBy('id','desc')->get();

        return response([
            'status' => 200,
            'categories' => $categories
        ]);
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:categories,name',
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;

        if($request->input('imageCategory')){
            $imgTemp = public_path('uploads/temp/'.$request->input('imageCategory'));
            $imgCate = public_path('uploads/category/'.$request->Input('imageCategory'));
            if(file_exists($imgTemp)){
                copy($imgTemp, $imgCate);
                unlink($imgTemp);
            }

            $category->image = $request->Input('imageCategory');
        }
            $category->save();

            return response([
                'status' => 200,
                'message' => 'Category created successfully',
            ]);
        }else{
            return response([
                'status' => 500,
                'message' => 'Failed to create category',
                'errors' => $validator->errors()
            ]);
        }

    }
    public function upload(Request $request){

        $validator = Validator::make($request->all(),[
            'image' => 'required',
        ]);

        if(($validator->passes())){
            if(!empty($request->file('image'))){
                $file = $request->file('image');

                $imaegName = rand(0,99999999).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/temp'), $imaegName);

                return response([
                    'status' => 200,
                    'message' => 'Image uploaded successfully',
                    'image' => $imaegName
                ]);
            }
        }else{
            return response([
                'status' => 500,
                'message' => 'Failed to upload image',
                'errors' => $validator->errors()
            ]);
        }
    }
    public function cancel(Request $request){

        if($request->image){
            $imagePath = public_path('uploads/temp/'.$request->image);
            if(file_exists($imagePath)){
                unlink($imagePath);
                return response([
                    'status' => 200,
                    'message' => 'Image cancel successfully'
                ]);
            }
        }
    }
    public function destroy(Request $request){
        $category = Category::find($request->id);
        // Checking category not found
        if($category == null){
            return response([
                'status' => 404,
                'message' => 'Category not found with id ' . $request->id
            ]);
        }
        // Delete image from public/uploads/category
        if($category->image){
            $imagePath = public_path('uploads/category/'.$category->image);
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
        // Delete category
        $category->delete();

        return response([
            'status' => 200,
            'message' => 'Delete category successfully',
        ]);
    }
    public function edit(Request $request){
        $category = Category::find($request->id);
        // Checking category not found
        if($category == null){
            return response([
                'status' => 404,
                'message' => 'Category not found with id ' . $request->id
            ]);
        }else{
            return response([
                'status' => 200,
                'category' => $category
            ]);
        }
    }
    public function update(Request $request){

        $category = Category::find($request->category_id);


        // Checking category not found
        if($category == null){
            return response([
                'status' => 404,
                'message' => 'Category not found with id ' . $request->category_id
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:categories,name,'.$category->id,
        ]);

        if($validator->passes()){
            $category->name = $request->name;
            $category->status = $request->status;

            // Change image Category
          if($request->input('imageCategory')){
                $imgTemp = public_path('uploads/temp/'.$request->input('imageCategory'));
                $imgCate = public_path('uploads/category/'.$request->Input('imageCategory'));
                if(File::exists($imgTemp)){
                    copy($imgTemp, $imgCate);
                    File::delete($imgTemp);
                }

                // Delete old image
                $oldImagePath = public_path('uploads/category/'.$category->image);
                // if(file_exists($oldImagePath)){
                //     unlink($oldImagePath);
                // }
                if(File::exists($oldImagePath)){
                    File::delete($oldImagePath);
                }

                $image = $request->input('imageCategory');

            }else if($request->input('old_image')){
                $image = $request->input('old_image');
            }

            $category->image = $image;
            $category->save();

            return response([
                'status' => 200,
                'message' => 'Category updated successfully',
            ]);
        }else{
            return response([
                'status' => 500,
                'message' => 'Failed to update category',
                'errors' => $validator->errors()
            ]);
        }
    }
}
