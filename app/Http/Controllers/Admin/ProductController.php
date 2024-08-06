<?php

namespace App\Http\Controllers\Admin;


use App\Models\Image;
use App\Models\Product;

use App\Models\Category;

use Illuminate\Http\Request;


use App\Models\ProductAttributes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest();
        if(!empty($request->get('keyword')))
        {
            $products = $products->with('category')->where('name','like','%'.$request->get('keyword').'%');
        }
        $products = $products->paginate(8);
        $data['products'] = $products;
        return view('admin.product.index',$data);
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $data['categories'] = $categories;
        return view('admin.product.create',$data);
    }

   
    public function store(Request $request)
{
    
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'qty' => 'required|integer|min:1',
        'category' => 'required|exists:categories,id',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $product = new Product();
    $product->title = $request->title;
    $product->description = $request->description;
    $product->qty = $request->qty;
    $product->category_id = (int) $request->category;
    if($request->hasFile('cover'))
    {
        // $files = $request->file('cover');
        // $imageName = time().'.'.$files->getClientOriginalExtension();
        // $files->move(public_path('cover/'),$imageName);
        // $manager = new ImageManager(['driver'=>'gd']);
        // $imagePath = public_path('cover/'.$imageName);
        // $image = $manager->make($imagePath)->encode('webp',60);
        // $webPath = pathinfo($imageName,PATHINFO_FILENAME).'.webp';
        // $image->save(public_path($webPath));
        // $product->cover = $webPath;
        $files = $request->file('cover');
        $imageName = time().'.'.$files->getClientOriginalExtension();
        $files->move(public_path('cover/'),$imageName);
        $manager = new ImageManager(['driver'=>'gd']);
        $imagePath = public_path('cover/'.$imageName);
        $image = $manager->make($imagePath)->encode('webp',60);
        // dd($image);
        $webPath = pathinfo($imagePath,PATHINFO_FILENAME).'.webp';
        $image->save(public_path($webPath));
        $product->cover = $webPath;

    }
    $product->save();

    // if($request->hasFile('images'))
    // {
    //     $files = $request->file('images');
    //     foreach ($files as $file) {
    //         $imageName = time().'.'.$file->getClientOriginalExtension();
    //         $request['product_id'] = $product->id;
    //         $request['image'] = $imageName;
    //         $file->move(public_path('images/'),$imageName);
    //         $manager =  new ImageManager(['driver'=>'gd']);
    //         $imagePath = public_path('images/'.$imageName);
    //         $image = $manager->make($imagePath)->encode('webp',60);
    //         $webPath = pathinfo($imagePath,PATHINFO_FILENAME).'.webp';
    //         $image->save(public_path($webPath));
    //         Image::create($request->all());
    //     }
    // }
    if ($request->hasFile('images')) {
        $files = $request->file('images');
        foreach ($files as $file) {
            $imageName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/'), $imageName);
            $manager = new ImageManager(['driver' => 'gd']);
            $imagePath = public_path('images/' . $imageName);
            $image = $manager->make($imagePath)->encode('webp', 60);
            $webPath = 'images/' . pathinfo($imageName, PATHINFO_FILENAME) . '.webp';
            $image->save(public_path($webPath));
            
            $imageModel = new Image();
            $imageModel->product_id = $product->id;
            $imageModel->image = $webPath;
            $imageModel->save();
        }
    }

    return redirect()->route('product.index');
    

    
}

public function edit(Request $request, $id)
{
    $products = Product::find($id);
    $categories = Category::latest()->get();

    $data['categories'] = $categories;
    $data['products'] = $products;
    return view('admin.product.edit',$data);
}



public function update(Request $request, $id)
{
    $product = Product::find($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'qty' => 'required|integer|min:1',
        'category' => 'required|exists:categories,id',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $product->title = $request->title;
    $product->description = $request->description;
    $product->qty = $request->qty;
    $product->category_id = (int) $request->category;

    if ($request->hasFile('cover')) {
        if (File::exists(public_path('cover/' . $product->cover))) {
            File::delete(public_path('cover/' . $product->cover));
        }

        $file = $request->file('cover');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('cover/'), $imageName);
        $manager = new ImageManager(['driver' => 'gd']);
        $imagePath = public_path('cover/' . $imageName);
        $image = $manager->make($imagePath)->encode('webp', 60);
        $webPath = pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';
        $image->save(public_path($webPath));
        $product->cover = $webPath;
    }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $imageName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/'), $imageName);
            $manager = new ImageManager(['driver' => 'gd']);
            $imagePath = public_path('images/' . $imageName);
            $image = $manager->make($imagePath)->encode('webp', 60);
            $webPath = 'images/' . pathinfo($imageName, PATHINFO_FILENAME) . '.webp';
            $image->save(public_path($webPath));

            $imageModel = new Image();
            $imageModel->product_id = $product->id;
            $imageModel->image = $webPath;
            $imageModel->save();
        }
    }

    $product->save();

    return redirect()->route('product.index');
}

public function delete(Request $request,$id)
{
    $products = Product::find($id);
    if(File::exists('cover/'.$products->cover))
    {
        File::delete('cover/'.$products->cover);
    }

    $images = Image::where('product_id',$products->id)->get();
    foreach ($images as $image) {
        if(File::exists('images/'.$image->image))
        {
            File::delete('images/'.$image->image);
        }
        $image->delete();
    }

    $products->delete();
    return redirect()->route('product.index');
}


public function deleteImages($id)
{
    $images = Image::find($id);
    if(File::exists('images/'.$images->image))
    {
        File::delete('images/'.$images->image);
    }
    Image::find($id)->delete();
    return back();
}

public function getProductAttributes($id)
{
    $attribute = ProductAttributes::with(['size', 'color'])
        ->findOrFail($id);

    return response()->json([
        'price' => $attribute->price,
        'purchasing_price' => $attribute->purchasing_price,
        'color' => $attribute->color ?? 'N/A'
    ]);
}
}

