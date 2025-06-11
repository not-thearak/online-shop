<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){

        return view('back-end.product');
    }

    public function list(Request $request){

        $limit = 10;
        $page = $request->page;
        $offset = ($page - 1) * $limit;

        // If search is provided, filter products
        if(!empty($request->search)){
            $products = Product::where('name', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->with(['Category', 'Brand', 'Images'])
            ->orWhereHas('Category', function($feild) use ($request){
                $feild->where('name', 'like', '%'. $request->search. '%');
            })
            ->orWhereHas('Brand', function($feild) use ($request){
                $feild->where('name', 'like', '%'. $request->search. '%');
            })
            ->limit($limit)
            ->offset($offset)
            ->get();
            // total page count
             $totalpageProducts = Product::where('name', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->with(['Category', 'Brand', 'Images'])
            ->orWhereHas('Category', function($feild) use ($request){
                $feild->where('name', 'like', '%'. $request->search. '%');
            })
            ->orWhereHas('Brand', function($feild) use ($request){
                $feild->where('name', 'like', '%'. $request->search. '%');
            })->count();

            }else{
            $products = Product::orderBy('id', 'desc')
            ->with(['Category', 'Brand', 'Images'])
            ->limit($limit)
            ->offset($offset)
            ->get();
            // total page count
            $totalpageProducts = Product::count();


        }


        $totalpage = ceil($totalpageProducts / $limit);


            return response([
                'status' => 200,
                'page' => [
                    'totalpageProducts' => $totalpageProducts,
                    'totalpage' => $totalpage,
                    'currentpage' => $page,
                ],
                'data' => $products
            ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        if($validator->passes()){

            // Store product to database
            $product = new Product();
            $product->name = $request->title;
            $product->category_id = $request->category;
            $product->desc = $request->desc;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->brand_id = $request->brand;
            $product->color = implode(',', $request->color);
            // [1,2,3] => "1,2,3"
            $product->user_id = Auth::user()->id;
            $product->status = $request->status;

            $product->save();

            // If product has images, store them
            if($request->image_uploads != null){
                $images = $request->image_uploads;
                foreach($images as $img){
                    $image = new ProductImage();
                    $image->product_id = $product->id;
                    $image->image = $img;

                    // Move image from temp to product images folder
                    if(File::exists(public_path('uploads/temp/'.$img))){
                        // Copy image from temp folder to product images folder
                        File::copy(public_path('uploads/temp/'.$img), public_path('uploads/product/'.$img));
                        // Delete image from temp folder
                        File::delete(public_path('uploads/temp/'.$img));
                    }

                    $image->save();
                }
            }

            return response([
                'status' => 200,
                'message' => 'Product created successfully',
            ]);

        }else{
            return response([
                'status' => 500,
                'message' => 'Failed to create product',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request){
        $product = Product::find($request->id);
        $productImages = ProductImage::where('product_id', $request->id)->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $colors = Color::orderBy('id', 'desc')->get();

        return response([
            'status' => 200,
            'data' => [
                'product' => $product,
                'productImages' => $productImages,
                'categories' => $categories,
                'brands' => $brands,
                'colors' => $colors
            ]
        ]);
    }

    public function data(){
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $colors = Color::orderBy('id', 'desc')->get();

        return response([
            'status' => 200,
            'data' => [
                'categories' => $categories,
                'brands' => $brands,
                'colors' => $colors
            ]
        ]);
    }

    public function update(Request $request){

        $product = Product::find($request->product_id);

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        if($validator->passes()){

            // Store product to database

            $product->name = $request->title;
            $product->category_id = $request->category;
            $product->desc = $request->desc;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->brand_id = $request->brand;
            $product->color = implode(',', $request->color);
            // [1,2,3] => "1,2,3"
            $product->user_id = Auth::user()->id;
            $product->status = $request->status;

            $product->save();

            // If product has images, store them
            if($request->image_uploads != null){
                $images = $request->image_uploads;
                foreach($images as $img){
                    $image = new ProductImage();
                    $image->product_id = $product->id;
                    $image->image = $img;

                    // Move image from temp to product images folder
                    if(File::exists(public_path('uploads/temp/'.$img))){
                        // Copy image from temp folder to product images folder
                        File::copy(public_path('uploads/temp/'.$img), public_path('uploads/product/'.$img));
                        // Delete image from temp folder
                        File::delete(public_path('uploads/temp/'.$img));
                    }

                    $image->save();
                }
            }

            return response([
                'status' => 200,
                'message' => 'Product Updated successfully',
            ]);

        }else{
            return response([
                'status' => 500,
                'message' => 'Failed to create product',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request){
        // Delete image from folder
        $productImages = ProductImage::where('product_id',$request->id)->get();

        if($productImages != null){
            foreach($productImages as $image){
                File::delete(public_path("uploads/product/$image->image"));
            }
        }

        // Delete product from db
        Product::find($request->id)->delete();

        return response([
            'status' => 200,
            'message' => 'Product Delete Succcessul'
        ]);
    }

}
