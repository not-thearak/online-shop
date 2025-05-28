<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){

        $categories = Category::orderBy('id', 'desc')->get();

        return view('back-end.brand', compact('categories'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:brands,name'
        ]);

        if($validator->passes()){
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->category_id = $request->category;
            $brand->status = $request->status;
            $brand->save();

            return response([
                'status' => 200,
                'message' => 'Brand created successfully',
            ]);
        }else{

            return response([
                'status' => 500,
                'message' => 'Failed to create Brand',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function list(){

        $brands = Brand::orderBy('id', 'desc')->with('category')->get();

        return response([
            'status' => 200,
            'brands' => $brands
        ]);
    }

    public function destroy(Request $request){
        $brand = Brand::find($request->id);

        if($brand == null){
            return response([
                'status' => 404,
                'message' => 'Brand not found'
            ]);
        }else{
            $brand->delete();
            return response([
                'status' => 200,
                'message' => 'Brand deleted successfully'
            ]);
        }
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->passes()){
            $brand = Brand::find($request->brand_id);
            if($brand == null){
                return response([
                    'status' => 404,
                    'message' => 'Brand not found'
                ]);
            }
            $brand->name = $request->name;
            $brand->category_id = $request->category;
            $brand->status = $request->status;
            $brand->save();

            return response([
                'status' => 200,
                'message' => 'updaet brand successfully',
            ]);
        }else{
            return response([
                'status' => 500,
                'message' => 'update brand falsed',
                'errors' => $validator->errors()
            ]);
        }


    }
}
