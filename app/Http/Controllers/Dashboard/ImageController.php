<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function uploads(Request $request){
        if($request->hasFile('image')){

            $files = $request->file('image');
            $images = [];
            foreach($files as $file){
                $fileName = rand(0,99999999).'.'.$file->getClientOriginalExtension();
                $images[] = $fileName;
                $file->move(public_path('uploads/temp'), $fileName);
            }
        }
        return response([
            'status' => 200,
            'message' => 'Images uploaded successfully',
            'images' => $images
        ]);
    }

    public function cancel(Request $request){

        $tempPath = public_path('uploads/temp/'.$request->image);
        $productPath = public_path('uploads/product/'.$request->image);

        if(File::exists($tempPath) || File::exists($productPath)){

            if(File::exists($tempPath)){

                File::delete($tempPath);

            }elseif(File::exists($productPath)){

                // delete image from db
                ProductImage::where('image',$request->image)->delete();

                File::delete($productPath);

            }

            return response([
                'status' => 200,
                'message' => 'Image deleted successfully'
            ]);
        } else {
            return response([
                'status' => 404,
                'message' => 'Image not found'
            ]);
        }
    }
}
