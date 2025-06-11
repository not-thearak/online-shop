<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        return view('back-end.color');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:colors,name'
        ]);

        if($validator->passes()){
            $color = new Color();
            $color->name = $request->name;
            $color->color_code = $request->color;
            $color->status = $request->status;
            $color->save();

            return response([
                'status' => 200,
                'message' => 'Color created successfully',
            ]);
        }else{

            return response([
                'status' => 500,
                'message' => 'Failed to create Color',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function list(Request $request){
        $limit = 5;
        $page = $request->page;
        $offset = ($page - 1) * $limit;

        if(!empty($request->search)){
              $colors = Color::where('name', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->limit($limit)->offset($offset)->get();
              $totalpageColors = Color::where('name', 'like', '%'.$request->search.'%')->count();
        }else{
            $colors = Color::orderBy('id', 'desc')->limit($limit)->offset($offset)->get();
            $totalpageColors = Color::count();
        }



        // total count of brands

        $totalpage = ceil($totalpageColors / $limit);

        return response([
            'status' => 200,
            'page' => [
                'totalpageColors' => $totalpageColors,
                'totalpage' => $totalpage,
                'currentpage' => $page,
            ],
            'colors' => $colors
        ]);
    }

    public function destroy(Request $request){
        $color = Color::find($request->id);

        if($color == null){
            return response([
                'status' => 404,
                'message' => 'Color not found'
            ]);
        }else{
            $color->delete();
            return response([
                'status' => 200,
                'message' => 'Color deleted successfully'
            ]);
        }
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:colors,name,'.$request->color_id,
        ]);

        if($validator->passes()){
            $color = Color::find($request->color_id);
            if($color == null){
                return response([
                    'status' => 404,
                    'message' => 'Color not found'
                ]);
            }
            $color->name = $request->name;
            $color->color_code = $request->color;
            $color->status = $request->status;
            $color->save();

            return response([
                'status' => 200,
                'message' => 'updaet color successfully',
            ]);
        }else{
            return response([
                'status' => 500,
                'message' => 'update color falsed',
                'errors' => $validator->errors()
            ]);
        }


    }
}
