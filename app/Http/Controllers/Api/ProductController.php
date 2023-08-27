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
        $product_arr = [];
        $result = [];
        $products = Product::with('tag');
        // Tag filter
        if($tagId !== null && $tagId > 0){
            $products = $products->where('tag_id','=',$tagId);            
        }
        // Search filter
        if(is_string($search)){
            $products = $products->search($search);            
        }

        $products = $products->paginate()->withQueryString();
        // return $products;
        foreach($products as $product){
            $list['id'] = $product->id;
            $list['name'] = $product->name;
            $list['image'] = asset('storage/'.$product->image);
            $list['description'] = $product->description;
            $list['tag'] = $product->tag;

            $product_arr[] = $list;
        }

        $result['data'] = $product_arr;

        return $result;
        
    }

    // Product show
    // *********************
    public function detail(Product $product){ 
        
        $result = [];          
        if($product){
             $result['id'] = $product->id;
             $result['name'] = $product->name;
             $result['image'] = asset('storage/'.$product->image);
             $result['description'] = $product->description;
             $result['tag_id'] = $product->tag_id;
             $result['extras'] = $product->extras;
             $result['created_at'] = $product->created_at;
             $result['updated_at'] = $product->updated_at;
        }
        return $result;
    }
}
