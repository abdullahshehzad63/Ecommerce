<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributeValues;
use Illuminate\Http\Request;
// use App\Models\AttributeValue;
use Illuminate\Support\Facades\Validator;

class AttributeValue extends Controller
{
    public function index(Request $request)
    {
        $attributeValues = ProductAttributeValues::latest();
        if(!empty($request->get('keyword')))
        {
            $attributeValues = $attributeValues->where('name','like','%'.$request->get('keyword').'%');
        }
        $attributeValues = $attributeValues->paginate(5);
        $data['attributeValues'] = $attributeValues;
       return view('admin.attributeValue.index',$data);
    }

    public function create()
    {
        return view('admin.attributeValue.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'size'=>'required|unique:attribute_values',
            'color'=>'required|unique:attribute_values',
            'material'=>'required|unique:attribute_values',
        ]);

        if($validator->passes())
        {
            $attributeValue = new ProductAttributeValues();
            $attributeValue->size= $request->size;
            $attributeValue->color = $request->color;
            $attributeValue->material = $request->material;

            $attributeValue->save();
            return response()->json(['status'=>true,'message'=>'Attribute Value is created Successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }
    }

    public function edit(Request $request,$id)
    {
        $attributeValues = ProductAttributeValues::find($id);
        $data['attributeValues'] = $attributeValues;
        return view('admin.attributeValue.edit',$data);
    }

    public function delete(Request $request,$id)
    {
        $attributeValues = ProductAttributeValues::find($id);
        $attributeValues->delete();
        return response()->json(['status'=>true,'message'=>'The Attribute Value is deleted Successfully']);
    }

    public function update(Request $request,$id)
    {
        $attributeValues = ProductAttributeValues::find($id);
        $validator = Validator::make($request->all(),[
            'size'=>'required',
            'color'=>'required',
            'material'=>'required',
        ]);

        if($validator->passes())
        {
            $attributeValues->size = $request->size;
            $attributeValues->color = $request->color;
            $attributeValues->material = $request->material;
            $attributeValues->save();
            return response()->json(['status'=>true,'message'=>'Product Attribute is updated successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'Product Attribute is deleted Successfully']);
        }
    }
}
