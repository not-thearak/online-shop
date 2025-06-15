<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class SingleProductController extends Controller
{
    Public function singleProduct(string $id){
        $product = Product::with(['Images', 'Category', 'Brand'])->find($id);

        // Show relate Product Brands
        $related_products = Product::with('Images') ->where('brand_id', $product->brand_id)
        ->where('price','>=',$product->price - 100)
        ->where('price','<=',$product->price + 100)
        ->where('status',1)->where('price', '>=', $product->price + 50)
        ->limit(4)->get();

        //Convert string to array
        $colorIds = explode(',', $product->color);
        // Fetch string to array
        $colors = Color::whereIn('id',$colorIds)->get();

        // $data['product'] = ;
        // return $product;
        return view('front-end.single-product', [
            'product' => $product,
            'colors' => $colors,
            'related_products' => $related_products
        ]);
    }
}




