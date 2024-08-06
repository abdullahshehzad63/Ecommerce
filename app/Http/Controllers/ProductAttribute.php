<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttributeValues;
use Illuminate\Http\Request;
use App\Models\ProductAttributes;
use Illuminate\Support\Facades\Validator;

class ProductAttribute extends Controller
{
    public function index(Request $request)
    {
        $products = ProductAttributes::latest();
        if(!empty($request->get('keyword')))
        {
            $products = $products->where('size','like','%'.$request->get('keyword').'%')->orWhere('color','like','%'.$request->get('keyword').'%');
        }
        $products = $products->with('product')->paginate(8);
        $data['products'] = $products;
        return view('admin.productattribute.index',$data);
    }

    public function create(){
        $attributeValues = ProductAttributeValues::latest()->get();
        $products = Product::latest()->get();
        $data['products'] = $products;
        $data['attributeValues'] = $attributeValues;
        return view('admin.productattribute.create',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'size'=>'required',
            'color'=>'required',
            'price'=>'required',
            'purchasing_price'=>'required',
            'product_id'=>'required',

        ]);
        if($validator->passes())
        {
            $productAttributes = new ProductAttributes();
            $productAttributes->size = $request->size;
            $productAttributes->color = $request->color;
            $productAttributes->price = $request->price;
            $productAttributes->purchasing_price = $request->purchasing_price;

            $productAttributes->product_id = $request->product_id;
           $productAttributes->material = $request->material;

            $productAttributes->save();
            return response()->json(['status'=>true,'message'=>'Product Attribute is created successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'Product Attribute is Not Created Successfully']);
        }
        
    }

    public function edit(Request $request,$id)
    {
        $attributeValues = ProductAttributeValues::latest()->get();

        $productAttribute = ProductAttributes::find($id);
        $products = Product::latest()->get();
        $data['productAttribute'] = $productAttribute;
        $data['products'] = $products;
        $data['attributeValues'] = $attributeValues;
        return view('admin.productattribute.edit',$data);

    }

    public function update(Request $request,$id)
    {
        $productAttribute = ProductAttributes::find($id);
        $validation = Validator::make($request->all(),[
            'size'=>'required',
            'color'=>'required',
            'price'=>'required',
            'purchasing_price'=>'required',
            'product_id'=>'required',
        ]);
        if($validation->passes())
        {
     
            $productAttribute->size = $request->size;
            $productAttribute->color = $request->color;
            $productAttribute->material = $request->material;
            $productAttribute->product_id = $request->product_id;
            $productAttribute->price = $request->price;
            $productAttribute->purchasing_price = $request->purchasing_price;
            $productAttribute->save();

            return response()->json(['status'=>true,'message'=>'The Product Attribute is updated successfully']);


        }
        else
        {
            return response()->json(['status'=>false,'message'=>'The Product Attribute is not updated successfully']);
        }
    }
    public function delete(Request $request,$id)
    {
        $products = ProductAttributes::find($id);
        $products->delete();
        return response()->json(['status'=>true,'message'=>'The Product Attribute is deleted Successfully']);
    }

   
    public function getAttributeDetails(Request $request)
    {
        $attributeId = $request->input('attribute_id');
        $attribute = ProductAttributes::with('color')->find($attributeId);

        if ($attribute) {
            return response()->json([
                'success' => true,
                'color' => $attribute->color->color,
                'price' => $attribute->price,
                'purchasing_price'=>$attribute->purchasing_price
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function productGetAttributeDetails($productId)
    {
        $attributes = ProductAttributes::where('product_id', $productId)->with(['size', 'color','product'])->get();
    
        if ($attributes) {
            return response()->json($attributes);
        } else {
            return response()->json(['success' => false]);
        }
    }

      

 
    
 


 
    

 


 
}
