<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        // Get laasted 3 categories
        $categories = Category::orderBy('id', 'desc')->limit(3)->get();

        // Get product
        $products = Product::orderBy('id', 'desc')->where('status', 1)->with('Images')->limit(9)->get();

        $data['categories'] = $categories;
        $data['products'] = $products;

        return view('front-end.index', $data);
    }

     public function productCategory(string $id){


        $products = Product::where('category_id',$id)
                    ->where('status',1)->with('Images')
                    ->paginate(9);


        if(!$products){
            return response()->json([
               'status' => 404,
               'message' => 'Category not found'
            ]);
        }

        return view('front-end.shop',[
            'products' => $products
        ]);

    }

    public function viewProduct(Request $request){
        // Fetch product details
        $product = Product::where('id',$request->id)->with('Images')->first();

        // Check if product exists
        if(!$product){
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);
    }
}
