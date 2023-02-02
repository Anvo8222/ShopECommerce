<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs</title>
    <style>
        .ratings_over {
            color: orange !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        <div class="col-sm-9 padding-right">
            <div class="product-details">
                <!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{{ url('upload/product/' . $product->id_user . '/' . 'hinh200_' . explode('full_', json_decode($product->image)[0])[1]) }}"
                            alt="" style="" />
                        <a href="{{ url('upload/product/full/' . json_decode($product->image)[0]) }}" rel="prettyPhoto">
                            <h3>ZOOM</h3>
                        </a>
                    </div>
                    <div id="similar-product" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div style="display: flex" class="carousel-inner">
                            @foreach (json_decode($product->image) as $image)
                                <div style="display: flex" class="item active">
                                    <img style="width:45px;height: 45px;"
                                        src="{{ url('upload/product/' . $product->id_user . '/' . 'hinh50_' . explode('full_', $image)[1]) }}"
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                        <!-- Controls -->
                        <a class="left item-control" href="#similar-product" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right item-control" href="#similar-product" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="product-information">
                        <!--/product-information-->
                        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                        <h2>{{ $product->name }}</h2>
                        <p class="id_product" id="{{ $product->id }}">Web ID: {{ $product->id }}</p>
                        <img src="images/product-details/rating.png" alt="" />
                        <span>
                            <span>US $<label class="product_price">{{ $product->price }}</label></span>
                            <label>Quantity:</label>
                            <input class="product_quantity" type="number" min="1" value="1" />
                            <span hidden style="font-size:20px; color:red;" class="err_quantity"></span>
                            <button type="button" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                        </span>
                        <p><b>Availability:</b> In Stock</p>
                        <p><b>Condition:</b> New</p>
                        <p id="{{ $product->id_brand }}"><b>Brand:</b> {{ $brandName }}</p>
                        <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                alt="" /></a>
                    </div>
                    <!--/product-information-->
                </div>
            </div>
            <!--/product-details-->

            <div class="category-tab shop-details-tab">
                <!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#details" data-toggle="tab">Details</a></li>
                        <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                        <li><a href="#tag" data-toggle="tab">Tag</a></li>
                        <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="details">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade active in" id="reviews">
                        <div class="col-sm-12">
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p><b>Write Your Review</b></p>

                            <form action="#">
                                <span>
                                    <input type="text" placeholder="Your Name" />
                                    <input type="email" placeholder="Email Address" />
                                </span>
                                <textarea name=""></textarea>
                                <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                <button type="button" class="btn btn-default pull-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>
@section('script')
    <script>
        $(document).ready(function() {

            $('.item').click(function() {
                let imageAcctive = $(this).find('img').attr('src').replace('hinh50', 'hinh200');
                $('.view-product').find('img').attr('src', imageAcctive);
                $('.view-product').find('a').attr('href', imageAcctive.replace('hinh200', 'full'));
            })
            //add to cart
            $('button.cart').click(function() {
                const nameProduct = $('.product-information').find('h2').text();
                const idProduct = $('.product-information').find('.id_product').attr('id');
                const priceProduct = $('.product_price').text();
                const quantityProduct = $('.product_quantity').val();
                const imageProduct = $('.view-product').find('img').attr('src');
                const nameImageProduct = imageProduct.split('/')[imageProduct.split('/').length - 1];
                if (quantityProduct > 0) {
                    if (!$('.err_quantity').is(":hidden")) {
                        $('.err_quantity').hide();
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/fe/add-to-cart',
                        type: 'post',
                        dataType: 'JSON',
                        data: {
                            nameProduct: nameProduct,
                            idProduct: idProduct,
                            priceProduct: priceProduct,
                            quantityProduct: quantityProduct,
                            nameImageProduct: nameImageProduct
                        },
                        success: function(result) {
                            console.log('cart:', result.cart);
                            $('.cart_quantity').find('span').text('Cart ' + result.quantity)
                        }
                    });
                } else {
                    $('.err_quantity').show().text('Số lượng lớn hơn 1!');
                }
            })
        });
    </script>
@endsection

</html>
