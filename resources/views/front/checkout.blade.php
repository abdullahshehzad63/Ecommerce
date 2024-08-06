@extends('front.include.app')

@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('front.home') }}">Home</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{ route('checkout.store') }}" id="checkoutUserForm" method="POST" name="checkoutUserForm">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code</h6>
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>First Name<span>*</span></p>
                                    <input type="text" name="name" id="name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" name="lastname" id="lastname">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text" name="country" id="country">
                            <p></p>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" name="address" id="address" class="checkout__input__add"><p></p>
                            <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" id="address_1" name="address_1"><p></p>
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" id="city" name="city"><p></p>
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text" id="state" name="state">
                            <p></p>
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" id="postcode" name="postcode">
                            <p></p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" id="phone" name="phone">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" id="email" name="email">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes</p>
                            <input type="text" name="orderDescription" id="order_description" placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                        <div class="checkout__input">
                            <p>Payment Details<span>*</span></p>
                            <div id="card-element"><!-- Stripe card element --></div>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product &nbsp;&nbsp;Color <span>Price &nbsp; Quantity</span></div>
                            <ul class="checkout__total__products">
                                @foreach ($carts as $item)
                                <li>{{$productNames[$item['product_id']]}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item['color']}} <span>${{ $item['price'] }}&nbsp;&nbsp;*&nbsp;&nbsp;{{$item['quantity']}}</span></li>
                                @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                @php
                                    $subtotal = array_reduce($carts, function($sum, $item) {
                                        return $sum + ($item['price'] * $item['quantity']);
                                    }, 0);

                                    
                                @endphp
                                <li>Subtotal <span>${{ $subtotal }}</span></li>
                                {{-- <li>Total <span>{{$totalDifference}}</span></li> --}}
                             </ul>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection

@section('userJs')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
$(document).ready(function(){
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        $("#checkoutUserForm").submit(function(e){
            e.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                } else {
                    var form = $("#checkoutUserForm");
                    var hiddenInput = $('<input type="hidden" name="stripeToken" />');
                    hiddenInput.val(result.token.id);
                    form.append(hiddenInput);

                    form.get(0).submit();
                }
            });
        });
    });
 
    var stripe = '{{'STRIPE_KEY'}}';
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount("#card-element");

    $("#checkoutUserForm").submit(function(e){
        e.preventDefault();
        stripe.createToken(card).then(function(result){
            if(result.error)
        {
            alert(response.error);
        }
        else{
            var form = $("#checkoutUserForm");
            var hiddenInput = $("<input type='hidden' name='stripeToken'/>");
            hiddenInput.val(result.token.id);
            form.append(hiddenInput);
            form.get(0).submit();
        }
        })
    })
    


    </script>
@endsection
