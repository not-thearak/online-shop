<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Images(){
        // Define the relationship with ProductImage One to Many
        return $this->hasMany(ProductImage::class , 'product_id', 'id');
    }
    public function Category(){
        // Define the relationship with Category Many to One
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function Brand(){
        // Define the relationship with Brand Many to One
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    // public function User(){
        // Define the relationship with User Many to One
    //     return $this->belongsTo(User::class);
    // }
}
