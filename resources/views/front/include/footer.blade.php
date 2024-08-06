<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="img/footer-logo.png" alt=""></a>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Clothing Store</a></li>
                        <li><a href="#">Trending Shoes</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Payment Methods</a></li>
                        <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{ asset('front-assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('front-assets/js/mixitup.min.js') }}"></script>
<script src="{{ asset('front-assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front-assets/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        
        $('.size-option').on('change', function() {
            var attributeId = $(this).val();
            
            $.ajax({
                url: '/product/attributes/' + attributeId,
                method: 'GET',
                success: function(response) {
                    $('#product-price').text('$' + response.price);
                    $('#purchasing-product-price').text('$' + response.purchasing_price);
                    $('#product-color').text(response.color);
                },
                error: function(xhr) {
                    console.error('An error occurred:', xhr);
                }
            });
        });

        
        
        

        function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            method: "GET",
            success: function(response) {
                $('#cart-count').text(response.count);
            }
        });
    }

    updateCartCount();  // Call this function on page load

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var product_id = $('.prod_id').val();
        var size_id = $('input[name="size"]:checked').val();
        var quantity = $('.qty-input').val();
        var price = $('#product-price').text().replace('$', '');
        var color = $('#product-color').text();

        if (!size_id) {
            alert('Please select a size.');
            return;
        }

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                product_id: product_id,
                size_id: size_id,
                quantity: quantity,
                price: price,
                color: color
            },
            success: function(response) {
                alert(response.message);
                updateCartCount();  
            
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    alert('Please log in to add products to your cart.');
                    window.location.href = "{{ route('login') }}";
                } else if (xhr.status === 409) {
                    alert('This product is already in your cart.');
                }
            }
        });
    });

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var qty = parseInt($('.qty-input').val());
        $('.qty-input').val(qty + 1);
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        var qty = parseInt($('.qty-input').val());
        if (qty > 1) {
            $('.qty-input').val(qty - 1);
        }
    });
    });


    // $(".deleteItemsFromCart").click(function(e){
    //     e.preveb
    // })

    // 

    $(document).ready(function() {
    $('.remove-item').click(function() {
        var $tr = $(this).closest('tr');
        var product_id = $tr.data('product-id');
        var size_id = $tr.data('size-id');
        var color = $tr.data('color');

        $.ajax({
            url: '{{ route("cart.remove") }}',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: product_id,
                size_id: size_id,
                color: color
            },
            success: function(response) {
                $tr.remove();
                alert(response.message);
                // Optionally, update the cart totals here
            },
            error: function(response) {
                alert('Failed to remove the item from the cart.');
            }
        });

     
    });

    function updateQuantity($button, newVal) {
        var productRow = $button.closest('tr');
        var productId = productRow.data('product-id');
        var sizeId = productRow.data('size-id');
        var color = productRow.data('color');

        $button.siblings('input').val(newVal);

        $.ajax({
            url: '{{ route('cart.update') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                size_id: sizeId,
                color: color,
                quantity: newVal
            },
            success: function(response) {
                if(response.success) {
                    productRow.find('.cart__price').text('$' + (response.itemTotal).toFixed(2));
                    $('.cart__total li span').text('$' + (response.cartTotal).toFixed(2));
                }
            }
        });
    }

    // Ensure click event is only bound once
    $(document).off('click', '.qtybtn').on('click', '.qtybtn', function() {
        var $button = $(this);
        var oldValue = $button.siblings('input').val();
        var newVal;

        if ($button.hasClass('inc')) {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        updateQuantity($button, newVal);
    });
});


</script>
@yield('userJs')
</body>

</html>
