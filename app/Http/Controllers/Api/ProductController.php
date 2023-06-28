<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Product Index
    // Product Search
    // Product filtered by Tag
    // *********************
    public function index($tagId = null, $search = null){
        $products = Product::with('tag');
        // Tag filter
        if($tagId == 0){
            return $products->paginate()->withQueryString();
        }
        // Tag filter
        if($tagId !== null){
            $products = $products->where('tag_id','=',$tagId);
        }
        // Search filter
        if(is_string($search)){
            $products = $products->search($search);
        }
        // Return
        return $products->paginate()->withQueryString();
    }

    // Product show
    // *********************
    public function show(Product $product){
        return $product;
    }
}
