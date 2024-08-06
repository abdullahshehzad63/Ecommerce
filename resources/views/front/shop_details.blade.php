@extends('front.include.app')
@section('content')
{{-- <section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{route('front.home')}}">Home</a>
                        <a href="#">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach ($productImages->images as $key=>$productMutlipleImages)
                        <li class="nav-item">
                            <a class="nav-link {{($key == 0)?'active':''}}" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{asset($productMutlipleImages->image)}}">
                                </div>
                            </a>
                        </li>
                            
                        @endforeach
                        
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{asset($products->cover)}}" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/product-big-3.png" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/product-big.png" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/product-big-4.png" alt="">
                                <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="video-popup"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{$products->title}}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        <h3>${{$products->product_attributes->price}}</h3>
                        <p>{{$products->description}}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->size)
                                        <label for="size_{{ $attribute->id }}">{{ $attribute->size->size }}
                                            <input type="radio" id="size_{{ $attribute->id }}" name="size">
                                        </label>
                                    @else
                                        <span>No size available</span>
                                    @endif
                                @empty
                                    <span>No sizes available</span>
                                @endforelse
                            </div>
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->color)
                                        <span>{{ $attribute->color->color }}</span>
                                    @else
                                        <span>No color available</span>
                                    @endif
                                @empty
                                    <span>No colors available</span>
                                @endforelse
                            </div>
                            
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input typ  e="text" value="1">
                                </div>
                            </div>
                            <a href="#" class="primary-btn">add to cart</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>SKU:</span> 3812912</li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                Previews(5)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                    pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                    pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="shop-details product_data">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ route('front.home') }}">Home</a>
                        <a href="#">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach ($products->images as $key => $productMutlipleImages)
                        
                            <li class="nav-item">
                                <a class="nav-link {{ ($key == 0) ? 'active' : '' }}" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset($productMutlipleImages->image) }}"></div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset($products->cover) }}" alt="">
                            </div>
                        </div>
                        <!-- Add other tabs content if necessary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            {{-- <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $products->title }}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        <h3>${{ $products->product_attributes->first()->price ?? 'N/A' }}</h3>
                        <p>{{ $products->description }}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->size)
                                        <label>
                                            <input type="radio" name="size" class="size-option" value="{{ $attribute->id }}">                                            {{$attribute->size->size }}
                                            
                                        </label>
                                    @else
                                        <span>No size available</span>
                                    @endif
                                @empty
                                    <span>No sizes available</span>
                                @endforelse
                            </div>
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->color)
                                        <span>{{ $attribute->color->color }}</span>
                                    @else
                                        <span>No color available</span>
                                    @endif
                                @empty
                                    <span>No colors available</span>
                                @endforelse
                            </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="input-group text-center mb-3" style="width: 10rem">
                                    <button class="input-group-text decrement-btn" > - </button>
                                    <input type="text" class="text-center qty-input form-control" name="quantity" value="1">
                                    <button class="input-group-text increment-btn" > + </button>
                                </div>
                           
                            </div>
                            <a href="#" class="primary-btn">Add to Cart</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> Add to Wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>SKU:</span> 3812912</li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $products->title }}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        
                        <h3 id="product-price">${{ $products->product_attributes->first()->price ?? 'N/A' }}</h3>
                        <p>{{ $products->description }}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->size)
                                        <label>
                                           
                                            <input type="radio" name="size" class="size-option" value="{{ $attribute->id }}">
                                            {{ $attribute->size->size }}
                                            
                                        </label>
                                    @else
                                        <span>No size available</span>
                                    @endif
                                @empty
                                    <span>No sizes available</span>
                                @endforelse
                            </div>
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                <span id="product-color">{{ $products->product_attributes->first()->color->color ?? 'N/A' }}</span>
                                
                            </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                
                                <input type="hidden" value="{{$products->id}}" class="prod_id">
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn "> - </button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                    <button class="input-group-text increment-btn "> + </button>
                                </div>

                            </div>
                            <a href="#" class="primary-btn addToCartBtn">Add to Cart</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> Add to Wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>SKU:</span> 3812912</li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $products->title }}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                    
                        <h3 id="product-price">${{ $products->product_attributes->first()->price ?? 'N/A' }}</h3>
                        
                        <h3 id="purchasing-product-price">${{ $products->product_attributes->first()->purchasing_price ?? 'N/A' }}</h3>
                        <p>{{ $products->description }}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->size)
                                        <label>
                                            <input type="radio" name="size" class="size-option" value="{{ $attribute->id }}">
                                            {{ $attribute->size ?? 'N/A' }}
                                        </label>
                                    @else
                                        <span>No size available</span>
                                    @endif
                                @empty
                                    <span>No sizes available</span>
                                @endforelse
                            </div>
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                @forelse ($products->product_attributes as $attribute)
                                    @if ($attribute->color)
                                        <span></span>
                                    @else
                                        <span>No color available</span>
                                    @endif
                                @empty
                                    <span>No colors available</span>
                                @endforelse
                                <span id="product-color"></span>
                            </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn"> - </button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                    <button class="input-group-text increment-btn"> + </button>
                                </div>
                            </div>
                            <a href="#" class="primary-btn addToCartBtn">Add to Cart</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> Add to Wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>SKU:</span> 3812912</li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer Reviews (5)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional Information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Information</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same capabilities as a modern PC...</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made from synthetic materials, not natural like wool...</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Add other tabs content if necessary -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
{{-- <section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-4">
                                <input type="radio" id="pc-4">
                            </label>
                            <label class="active black" for="pc-5">
                                <input type="radio" id="pc-5">
                            </label>
                            <label class="grey" for="pc-6">
                                <input type="radio" id="pc-6">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                        <span class="label">Sale</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Multi-pocket Chest Bag</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$43.48</h5>
                        <div class="product__color__select">
                            <label for="pc-7">
                                <input type="radio" id="pc-7">
                            </label>
                            <label class="active black" for="pc-8">
                                <input type="radio" id="pc-8">
                            </label>
                            <label class="grey" for="pc-9">
                                <input type="radio" id="pc-9">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Diagonal Textured Cap</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$60.9</h5>
                        <div class="product__color__select">
                            <label for="pc-10">
                                <input type="radio" id="pc-10">
                            </label>
                            <label class="active black" for="pc-11">
                                <input type="radio" id="pc-11">
                            </label>
                            <label class="grey" for="pc-12">
                                <input type="radio" id="pc-12">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection