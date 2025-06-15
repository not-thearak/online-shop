@extends('front-end.components.master')
@section('contents')
    <!-- Main Menu Section -->
    {{-- <section class="menu">
        <nav class="navbar navigation">
            <div class="container">
                <div class="navbar-header">
                    <h2 class="menu-title">Main Menu</h2>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div><!-- / .navbar-header -->

                <!-- Navbar Links -->
                <div id="navbar" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="index.html">Home</a>
                        </li><!-- / Home -->


                        <!-- Elements -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Shop <span
                                    class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">

                                    <!-- Basic -->
                                    <div class="col-lg-6 col-md-6 mb-sm-3">
                                        <ul>
                                            <li class="dropdown-header">Pages</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="pricing.html">Pricing</a></li>
                                            <li><a href="confirmation.html">Confirmation</a></li>

                                        </ul>
                                    </div>

                                    <!-- Layout -->
                                    <div class="col-lg-6 col-md-6 mb-sm-3">
                                        <ul>
                                            <li class="dropdown-header">Layout</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="product-single.html">Product Details</a></li>
                                            <li><a href="shop-sidebar.html">Shop With Sidebar</a></li>

                                        </ul>
                                    </div>

                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Elements -->


                        <!-- Pages -->
                        <li class="dropdown full-width dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Pages <span
                                    class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">

                                    <!-- Introduction -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">Introduction</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                        </ul>
                                    </div>

                                    <!-- Contact -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">Dashboard</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="dashboard.html">User Interface</a></li>
                                            <li><a href="order.html">Orders</a></li>
                                            <li><a href="address.html">Address</a></li>
                                            <li><a href="profile-details.html">Profile Details</a></li>
                                        </ul>
                                    </div>

                                    <!-- Utility -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">Utility</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="login.html">Login Page</a></li>
                                            <li><a href="signin.html">Signin Page</a></li>
                                            <li><a href="forget-password.html">Forget Password</a></li>
                                        </ul>
                                    </div>

                                    <!-- Mega Menu -->
                                    <div class="col-sm-3 col-xs-12">
                                        <a href="shop.html">
                                            <img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
                                        </a>
                                    </div>
                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Pages -->



                        <!-- Blog -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Blog <span
                                    class="tf-ion-ios-arrow-down"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                <li><a href="blog-full-width.html">Blog Full Width</a></li>
                                <li><a href="blog-grid.html">Blog 2 Columns</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                            </ul>
                        </li><!-- / Blog -->

                        <!-- Shop -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Elements
                                <span class="tf-ion-ios-arrow-down"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="alerts.html">Alerts</a></li>
                            </ul>
                        </li><!-- / Blog -->
                    </ul><!-- / .nav .navbar-nav -->

                </div>
                <!--/.navbar-collapse -->
            </div><!-- / .container -->
        </nav>
    </section> --}}
    <section class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="shop.html">Shop</a></li>
                        <li class="active">Single Product</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <ol class="product-pagination text-right">
                        <li><a href="blog-left-sidebar.html"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
                        <li><a href="blog-left-sidebar.html">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
                    </ol>
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-md-5">
                    <div class="single-product-slider">

                        {{-- test start --}}
                            <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                                <div class='carousel-outer'>
                                    <!-- Main image slider -->
                                    <div class='carousel-inner'>
                                        @foreach($product->Images as $key => $image)
                                            <div class='item @if($key == 0) active @endif'>
                                                <img src='{{ asset("uploads/product/" . $image->image) }}' alt='Product Image'
                                                    data-zoom-image="{{ asset("uploads/product/" . $image->image) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Navigation arrows -->
                                    <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                                        <i class="tf-ion-ios-arrow-left"></i>
                                    </a>
                                    <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                                        <i class="tf-ion-ios-arrow-right"></i>
                                    </a>
                                </div>

                                <!-- Thumbnail indicators -->
                                <ol class='carousel-indicators mCustomScrollbar meartlab'>
                                    @foreach($product->Images as $key => $image)
                                        <li data-target='#carousel-custom' data-slide-to='{{ $key }}' class='@if($key == 0) active @endif'>
                                            <img src='{{ asset("uploads/product/" . $image->image) }}' alt='Thumbnail' />
                                        </li>
                                    @endforeach
                                </ol>
                            </div>

                        {{-- test end --}}
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-details">
                         {{-- Product Name --}}
                        <h2>{{ $product->name }}</h2>
                        {{-- Product Price --}}
                        <p class="product-price">${{ number_format($product->price, 2) }}</p>
                             {{-- ${(product.desc.substring(0, 200) + '...')} --}}
                        {{-- Product Description --}}
                        <p class="product-description mt-20">
                            {{ $product->desc ? substr($product->desc, 0, 200) . '...' : 'No short description available.' }}
                        </p>

                        {{-- <p>{{ $product->long_description ?? 'No long description available.' }}</p> --}}
                          {{-- Color Swatches --}}
    <div class="color-swatches">
        <span>Color:</span>
        <ul>
            {{-- @if(isset($colors) && is_array($colors)) --}}
                @foreach($colors as $color)
                    <li><a href="#!" style="background-color: {{ $color->color_code }}; display: inline-block; width: 20px; height: 20px; border-radius: 50%;"></a></li>
                @endforeach
            {{-- @else
                <li><a href="#!" class="swatch-default"></a></li>
            @endif --}}
        </ul>
    </div>


                        {{-- <div class="product-size">
                            <span>Size:</span>
                            <select class="form-control">
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                        </div> --}}

                        {{-- <div class="product-quantity">
                            <span>Quantity:</span>
                            <div class="product-quantity-slider">
                                <input id="product-quantity" type="text" value="0" name="product-quantity">
                            </div>
                        </div> --}}

                        <div class="product-category">
                            <span>Category:</span>
                            @if($product->Category)
                                <a href="#">{{ $product->Category->name }}</a>
                            @else
                                <span>No category available</span>
                            @endif
                        </div>
                        <div class="product-category">
                            <span>Brand:</span>
                            @if($product->Brand)
                                <a href="#">{{ $product->brand->name }}</a>
                            @else
                                <span>No Brand available</span>
                            @endif
                        </div>






                        <a href="cart.html" class="btn btn-main mt-20">Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabCommon mt-20">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews
                                    (3)</a></li>
                        </ul>
                        <div class="tab-content patternbg">
                            <div id="details" class="tab-pane fade active in">
                                <h4>Product Description</h4>
                                 <p class="product-description mt-20">
                            {{ $product->desc ? substr($product->desc, 0, 2035) . '...' : 'No short description available.' }}
                        </p>
                            </div>
                            <div id="reviews" class="tab-pane fade">
                                <div class="post-comments">
                                    <ul class="media-list comments-list m-bot-50 clearlist">
                                        <!-- Comment Item start-->
                                        <li class="media">

                                            <a class="pull-left" href="#!">
                                                <img class="media-object comment-avatar" src="images/blog/avater-1.jpg"
                                                    alt="" width="50" height="50" />
                                            </a>

                                            <div class="media-body">
                                                <div class="comment-info">
                                                    <h4 class="comment-author">
                                                        <a href="#!">Jonathon Andrew</a>

                                                    </h4>
                                                    <time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
                                                    <a class="comment-button" href="#!"><i
                                                            class="tf-ion-chatbubbles"></i>Reply</a>
                                                </div>

                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at
                                                    magna ut ante eleifend eleifend.Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit. Quod laborum minima, reprehenderit laboriosam officiis
                                                    praesentium? Impedit minus provident assumenda quae.
                                                </p>
                                            </div>

                                        </li>
                                        <!-- End Comment Item -->

                                        <!-- Comment Item start-->
                                        <li class="media">

                                            <a class="pull-left" href="#!">
                                                <img class="media-object comment-avatar" src="images/blog/avater-4.jpg"
                                                    alt="" width="50" height="50" />
                                            </a>

                                            <div class="media-body">

                                                <div class="comment-info">
                                                    <div class="comment-author">
                                                        <a href="#!">Jonathon Andrew</a>
                                                    </div>
                                                    <time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
                                                    <a class="comment-button" href="#!"><i
                                                            class="tf-ion-chatbubbles"></i>Reply</a>
                                                </div>

                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at
                                                    magna ut ante eleifend eleifend. Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit. Magni natus, nostrum iste non delectus atque ab a
                                                    accusantium optio, dolor!
                                                </p>

                                            </div>

                                        </li>
                                        <!-- End Comment Item -->

                                        <!-- Comment Item start-->
                                        <li class="media">

                                            <a class="pull-left" href="#!">
                                                <img class="media-object comment-avatar" src="images/blog/avater-1.jpg"
                                                    alt="" width="50" height="50">
                                            </a>

                                            <div class="media-body">

                                                <div class="comment-info">
                                                    <div class="comment-author">
                                                        <a href="#!">Jonathon Andrew</a>
                                                    </div>
                                                    <time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
                                                    <a class="comment-button" href="#!"><i
                                                            class="tf-ion-chatbubbles"></i>Reply</a>
                                                </div>

                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at
                                                    magna ut ante eleifend eleifend.
                                                </p>

                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products related-products section">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row">

                @if ($related_products->isNotEmpty())
                    @foreach ($related_products as $product )
                    @php
                         if ($product->images != '') {
                                $img = $product->images->first();
                                $imageUrl = $img
                                    ? asset('uploads/product/'. $img->image)
                                    : asset('front-end/assets/images/shop/products/product-1.jpg');
                            }
                    @endphp
                        <div class="col-md-3">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <span class="bage">Sale</span>
                                    <img class="img-responsive" src="{{ $imageUrl }}" alt="{{ $product->name }}" />
                                    <div class="preview-meta">
                                        <ul>
                                            <li onclick="viewProduct({{ $product->id }})">
                                                <span data-toggle="modal" data-target="#product-modal">
                                                    <i class="tf-ion-ios-search-strong"></i>
                                                </span>
                                            </li>
                                            <li>
                                                <a href="#!"><i class="tf-ion-ios-heart"></i></a>
                                            </li>
                                            <li>
                                                <a href="#!"><i class="tf-ion-android-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-single.html">{{$product->name}}</a></h4>
                                    <p class="price">${{$product->price}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif




                <!-- Modal -->
                <div class="modal product-modal fade" id="product-modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="tf-ion-close"></i>
                    </button>
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-body view-product">
                                {{-- <div class="row">
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <div class="modal-image">
                                            <img class="img-responsive" src="images/shop/products/modal-product.jpg"
                                                alt="product-img" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="product-short-details">
                                            <h2 class="product-title">GM Pendant, Basalt Grey</h2>
                                            <p class="product-price">$200</p>
                                            <p class="product-short-description">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil
                                                cum. Illo laborum numquam rem aut officia dicta cumque.
                                            </p>
                                            <a href="cart.html" class="btn btn-main">Add To Cart</a>
                                            <a href="product-single.html" class="btn btn-transparent">View Product
                                                Details</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->

            </div>
        </div>
    </section>



    <!-- Modal -->
    <div class="modal product-modal fade" id="product-modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="tf-ion-close"></i>
        </button>
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="modal-image">
                                <img class="img-responsive" src="images/shop/products/modal-product.jpg" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="product-short-details">
                                <h2 class="product-title">GM Pendant, Basalt Grey</h2>
                                <p class="product-price">$200</p>
                                <p class="product-short-description">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil cum. Illo
                                    laborum numquam rem aut officia dicta cumque.
                                </p>
                                <a href="#!" class="btn btn-main">Add To Cart</a>
                                <a href="#!" class="btn btn-transparent">View Product Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
   <script>
        const viewProduct = (id) => {
            $.ajax({
                type: "GET",
                url: "{{ route('product.view') }}",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {

                        let product = response.product;

                        let productHTML = `
                                 <div class="row">
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <div class="modal-image">`;
                                        if (product.images.length >  0) {
                                            productHTML += `<img class="img-responsive" src="{{ asset('uploads/product/${product.images[0].image}') }}" />`;
                                        }

                                        productHTML += `
                                          </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="product-short-details">
                                            <h2 class="product-title">${product.name}</h2>
                                            <p class="product-price">$${product.price}</p>
                                            <p class="product-short-description">
                                                ${(product.desc.substring(0, 200) + '...')}
                                            </p>
                                            <a href="cart.html" class="btn btn-main">Add To Cart</a>
                                            <a href="/product/single/${product.id}" class="btn btn-transparent">View Product
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                             `;

                        $('.view-product').html(productHTML);

                    }
                }
            });
        }
   </script>
@endsection
