<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use App\Models\ProductAttributes;
use App\Http\Controllers\Controller;
use App\Models\ProductPurchaseDetail;
use App\Models\ProductAttributeValues;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $productPurchases = ProductPurchase::latest();
        if(!empty($request->get('keyword')))
        {
            $productPurchases = $productPurchases->where('id','like','%'.$request->get('keyword').'%');
        }
        $productPurchases = $productPurchases->paginate(10);
        $data['productPurchases'] = $productPurchases;
        return view('admin.productPurchases.index',$data);
    }

    public function create()
    {
        $attributeValues = ProductAttributeValues::latest()->get();
        $products = Product::latest()->get();
        $productAttributes = ProductAttributes::latest()->get();
        $data['attributeValues'] = $attributeValues;
        $data['products'] = $products;
        $data['productAttributes'] = $productAttributes;
        return view('admin.productPurchases.create',$data);
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'size'=>'required',
    //         'color'=>'required',
    //         'product_id'=>'required',
    //         'selling_price'=>'required',
    //         'purchasing_price'=>'required',
    //         // 'material'=>'required',
    //         'quantity'=>'required',
    //     ]);

    //     if($validator->passes())
    //     {
    //         $productPurchases = new ProductPurchase();
    //         $productPurchases->size_id = (!empty($request->size))? implode(',',($request->size)):'';
    //         $productPurchases->color_id= (!empty($request->color))?implode(',',($request->color)):'';
    //         // $productPurchases->material_id = (!empty($request->material))?implode(',',($request->material)):'';
    //         $productPurchases->product_id = $request->product_id;
    //         $productPurchases->quantity = $request->quantity;
    //         $productPurchases->selling_price = $request->selling_price;
    //         $productPurchases->totalPrice = $request->total_price;
    //         $productPurchases->purchasing_price = $request->purchasing_price;
    //         $productPurchases->save();

    //         return response()->json(['status'=>true,'message'=>'The Product Purchases is created Successfully']);
    //     }
    //     else
    //     {
    //         return response()->json(['status'=>false,'message'=>$validator->errors()]);
    //     }
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id.*' => 'required|integer|exists:products,id',
            'selling_price.*' => 'required|numeric',
            'purchasing_price.*' => 'required|numeric',
            'quantity.*' => 'required|integer|min:1',
            'total_price.*' => 'required|numeric',
        ]);

        $productPurchase = new ProductPurchase();
        $productPurchase->save();

        foreach ($request->product_id as $key => $productId) {
            $productPurchaseDetail = new ProductPurchaseDetail();
            $productPurchaseDetail->product_purchase_id = $productPurchase->id;
            $productPurchaseDetail->product_id = $productId;
            $productPurchaseDetail->selling_price = $request->selling_price[$key];
            $productPurchaseDetail->purchasing_price = $request->purchasing_price[$key];
            $productPurchaseDetail->quantity = $request->quantity[$key];
            $productPurchaseDetail->total_price = $request->total_price[$key];
            $productPurchaseDetail->save();
        }

        return redirect()->route('productPurchases.index')->with('success', 'Product Purchase created successfully.');
    }

    public function edit(Request $request,$id)
    {
        $productPurchases = ProductPurchase::find($id);
        $products = Product::latest()->get();
        $attributeValues = ProductAttributeValues::latest()->get();
        $productAttributes = ProductAttributes::latest()->get();
        $data['productPurchases'] = $productPurchases;
        $data['products'] = $products;
        $data['attributeValues'] = $attributeValues;
        $data['productAttributes'] = $productAttributes;
        return view('admin.productPurchases.edit',$data); 
    }

    public function update(Request $request,$id)
    {
        $productPurchases = ProductPurchase::find($id);
        $validator = Validator::make($request->all(),[
            'size'=>'required',
            'color'=>'required',
            
            'selling_price'=>'required',
            'purchasing_price'=>'required',
            'quantity'=>'required',
        ]);

        if($validator->passes())
        {
            $productPurchases = new ProductPurchase();
            $productPurchases->size_id = (!empty($request->size))? implode(',',($request->size)):'';
            $productPurchases->color_id= (!empty($request->color))?implode(',',($request->color)):'';
            // $productPurchases->material_id = (!empty($request->material))?implode(',',($request->material)):'';
            $productPurchases->product_id = $request->product_id;
            $productPurchases->quantity = $request->quantity;
            $productPurchases->selling_price = $request->selling_price;
            $productPurchases->totalPrice = $request->total_price;
            $productPurchases->purchasing_price = $request->purchasing_price;
            $productPurchases->save();

            return response()->json(['status'=>true,'message'=>'The Product Purchases is created Successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>$validator->errors()]);
        }
    
    }

    public function delete(Request $request,$id)
    {
        $productPurchases = ProductPurchase::find($id);
        $productPurchases->delete();
        return response()->json(['status'=>true,'message'=>'The Purchase is deleted successfully']);
    }


    public function trashedPurchasedProducts(Request $request)
    {  $productPurchases = ProductPurchase::latest();
        if(!empty($request->get('keyword')))
        {
            $productPurchases = $productPurchases->where('id','like','%'.$request->get('keyword').'%');
        }
        $productPurchases = $productPurchases->paginate(10);
        $data['productPurchases'] = $productPurchases;
        return view('admin.productPurchases.trashed',$data);
    }

    public function restored($id)
    {
        $productPurchases = ProductPurchase::withTrashed()->findOrFail($id);
        if(!empty($productPurchases))
        {
            $productPurchases->restore();
        }

        return redirect()->route('productPurchases.index');
    }

    public function permanentlyDeletedItems($id)
    {
        $productPurchases = ProductPurchase::withTrashed()->findOrFail($id);
        if(!empty($productPurchases))
        {
            $productPurchases->forceDelete();
        } 

        return redirect()->route('productPurchases.index')->with('success','Purchased Product is deleted Successfully');

    }
}

