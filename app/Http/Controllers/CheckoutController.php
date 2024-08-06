<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\ProductAttributes;
use App\Models\ProductAttributeValues;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        // Fetch cart items and related data
        $carts = session()->get('cart', []);
        $productNames = [];
        $sizes = [];

        foreach ($carts as $item) {
            $product = Product::find($item['product_id']);
            $productNames[$item['product_id']] = $product ? $product->title : 'Product not found';

            $size = ProductAttributes::find($item['size_id']);
            $sizes[$item['size_id']] = $size ? $size->size : 'Size not found';
 
            
        }


        return view('front.checkout', [
            'attributeValues' => ProductAttributeValues::latest()->get(),
            'carts' => $carts,
            'productNames' => $productNames,
            'sizes' => $sizes,
            'productAttributes' => ProductAttributes::latest()->get(),
            'products' => Product::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postcode' => 'required',
            'state' => 'required',
            'address' => 'required',
            'address_1' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'orderDescription' => 'required',
            'stripeToken' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $carts = session()->get('cart', []);
        $totalAmount = array_reduce($carts, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0) * 100; // Stripe expects the amount in cents
 
        // dd(env('STRIPE_SECRET'));
        // Stripe::setApiKey(env('STRIPE_SECRET'));

        // try {
        //     $paymentIntent = PaymentIntent::create([
        //         'amount' => $totalAmount,
        //         'currency' => 'usd',
        //         'description' => 'Order payment',
        //         // 'payment_method' => $request->stripeToken,
        //          "automatic_payment_methods[enabled]" => true,
        //         "automatic_payment_methods[allow_redirects]" => 'never',
        //         // 'confirm' => true,
        //     ]);
             
            //  if ($paymentIntent->status == 'succeeded') {
                $order = Order::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone_number' => $request->phone,
                    'code' => $request->postcode,
                    'city' => $request->city,
                    'country' => $request->country,
                    'address' => $request->address,
                    'address_1' => $request->address_1,
                    'state' => $request->state,
                    'order_description' => $request->orderDescription,
                ]);

                foreach ($carts as $item) {
                    OrderItem::create([
                        // 'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'color' => $item['color'],
                        'size' => $item['size_id'],
                        'price' => $item['price'],
                        'purchase_price'=> $item['purchase_price'],
                        'quantity' => $item['quantity']
                    ]);
                }
                


                session()->forget('cart');

                return response()->json(['status' => true, 'message' => 'Checkout has been placed and payment succeeded']);
            // } else {
            //     return response()->json(['status' => false, 'message' => 'Payment failed']);
            // }
        // } catch (\Exception $e) {
        //     return response()->json(['status' => false, 'message' => $e->getMessage()]);
        // }
    }

 
}
