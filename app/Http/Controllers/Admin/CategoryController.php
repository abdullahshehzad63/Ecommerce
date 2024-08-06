<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest();
        if(!empty($request->get('keyword')))
        {
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');
        }
        $categories = $categories->paginate(8);
        $data['categories'] = $categories;
        return view('admin.category.index',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required'
        ]);

        if($validator->passes())
        {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return response()->json(['status'=>true,'message'=>'Category is created Successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }
    }

    public function edit(Request $request,$id){
        $categories  = Category::find($id);
        $data['categories'] = $categories;
        return view('admin.category.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
        ]);
        if($validator->passes())
        {


        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json(['status'=>true,'message'=>'Category is updated successfully']);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'The Category is updated successfully']);
        }

    }

    public function delete(Request $request,$id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['status'=>true,'message'=>'Category is deleted successfully']);
    }
}
