<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductAttributeValues;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->limit(3)->get();
        $products = Product::with('product_attributes')->latest()->get();
        $attributeValues = ProductAttributeValues::latest()->get();
        $data['products'] = $products;
        $data['attributeValues'] = $attributeValues;
        $data['categories'] = $categories;
        return view('front.index',$data);
    }

    // public function shopDetails(Request $request,$id)

    // {   $products = Product::with(['product_attributes.size','product_attributes.color','images'])->find($id);
    //     // dd($products);
    //     $attributeValues = ProductAttributeValues::latest()->get();

    //     $productAttributes = ProductAttributes::latest()->get();
    //     // dd($productAttributes);
    //     $data['attributeValues'] = $attributeValues;
    //     $data['products'] = $products;
    //     $data['productAttributes'] = $productAttributes; 
        
    //     return view('front.shop_details',$data);
    // }

    public function shopDetails(Request $request, $id)
{
    $products = Product::with(['product_attributes.size', 'product_attributes.color', 'images'])->find($id);
    
    if (!$products) {
        abort(404);
    }

    $data['products'] = $products;
    
    return view('front.shop_details', $data);
}

////////////





}