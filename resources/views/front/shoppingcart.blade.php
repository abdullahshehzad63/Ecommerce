@extends('front.include.app')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $item)
                            <tr data-product-id="{{ $item['product_id'] }}" data-size-id="{{ $item['size_id'] }}" data-color="{{ $item['color'] }}">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{ $item['image_url'] ?? 'img/shopping-cart/default.jpg' }}" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{ $productNames[$item['product_id']] ?? 'Product Name' }}</h6>
                                        <h5>${{ $item['price'] }}</h5>
                                    </div>
                                </td>
                                <td class="cart__size">{{ $sizes[$item['size_id']] ?? 'N/A' }}</td>
                                <td class="cart__color">{{ $item['color'] ?? 'N/A' }}</td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <span class="dec qtybtn">-</span>
                                            <input type="text" value="{{ $item['quantity'] }}">
                                            <span class="inc qtybtn">+</span>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td class="cart__price">${{ (double)$item['price'] * (double)$item['quantity'] }}</td>
                                <td class="cart__close">
                                    <button class="remove-item"><i class="fa fa-close"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="#">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        @php
                            $subtotal = array_reduce($carts, function($sum, $item) {
                                return $sum + ((double)$item['price'] * (double)$item['quantity']);
                            }, 0);
                        @endphp
                        <li>Subtotal <span>${{ $subtotal }}</span></li>
                        <li>Total <span>${{ $subtotal }}</span></li>
                    </ul>
                    <a href="{{route('front.checkout')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
    
    
</section>
@endsection


