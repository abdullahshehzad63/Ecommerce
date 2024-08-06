<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductAttributeValues;
use session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Please log in to add products to your cart.'], 401);
        }

        $cart = session()->get('cart', []);

        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $color = $request->input('color');

        // Check if the product with the same size and color is already in the cart
        foreach ($cart as $item) {
            if ($item['product_id'] == $product_id && $item['size_id'] == $size_id && $item['color'] == $color) {
                return response()->json(['message' => 'This product is already in your cart.'], 409);
            }
        }


        $cart[] = [
            'product_id' => $product_id,
            'size_id' => $size_id,
            'quantity' => $quantity,
            'price' => $price,
            'color' => $color
        ];

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!']);
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = count($cart);
        dd($count);
        return response()->json(['count' => $count]);
    }
    public function shopping()
    {
        $carts = session()->get('cart', []);
        // dd($carts);
        $productNames = [];
        $sizes = [];

        foreach ($carts as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $productNames[$item['product_id']] = $product->title;
            }

            // Fetch size information
            // $size = ProductAttributes::find($item['size_id']);
            // if ($size) {
            //     $sizes[$item['size_id']] = $size->size;
            // }
            // dd($size);
            
        }
        
        $attributeValues = ProductAttributeValues::latest()->get();
        // dd($attributeValues);

        $data['attributeValues'] = $attributeValues;
        $data['carts'] = $carts;
        $data['productNames'] = $productNames;
        $data['sizes'] = $sizes;
        return view('front.shoppingcart', $data);
    }

    public function remove(Request $request)
    {

        $cart = session()->get('cart', []);
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $color = $request->input('color');


        $cart = array_filter($cart, function ($item) use ($product_id, $size_id, $color) {
            return !($item['product_id'] == $product_id && $item['size_id'] == $size_id && $item['color'] == $color);
        });


        $cart = array_values($cart);

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product removed from cart successfully!', 'cart' => $cart]);
    }

    // 
  
    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $size_id = $request->input('size_id');
        $color = $request->input('color');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['product_id'] == $product_id && $item['size_id'] == $size_id && $item['color'] == $color) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        session()->put('cart', $cart);

        // Calculate the new totals
        $itemTotal = $quantity * ($cart[array_search($item, $cart)]['price']);
        $cartTotal = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json([
            'success' => true,
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal
        ]);
    }

    // 
 


}
