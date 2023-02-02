<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('frontend.layouts.header')

    @if (!strpos(Route::current()->uri, 'cart'))
        @include('frontend.layouts.slide')
    @endif
    <section>
        <div class="container">
            <div class="row">
                @if (!strpos(Route::current()->uri, 'cart'))
                    @if (!strpos(Route::current()->uri, 'account'))
                        @include('frontend.layouts.menu-left')
                    @endif
                    <div class="col-sm-9 padding-right" style="overflow: hidden;">
                        @yield('content')
                    </div>
                @else
                    @yield('content')
                @endif
            </div>
        </div>
    </section>
    @include('frontend.layouts.footer')

</body>

<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/js/price-range.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
@yield('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
</script>

<script>
    $(document).ready(function() {
        $('.slider-track').click(function() {
            let value = $('.changePrice').val().split(",");
            let priceMin = value[0];
            let priceMax = value[1];
            console.log(typeof priceMin);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'search_fill_price',
                type: 'post',
                dataType: 'JSON',
                data: {
                    priceMin: Number(priceMin),
                    priceMax: Number(priceMax),
                },
                // <img src="../../upload/product/full/full_canh.jpg" 

                success: function(result) {
                    let html = "";
                    (result.products).forEach(item => {
                        html += `
                        <div class="col-sm-4">
                          <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ url('upload/product/full/${JSON.parse(item.image)[0]}') }}" 
                                        alt="product->name " />
                                    <h2>${item.price} </h2>
                                    <p> ${item.name} </p>
                                    <a href="#" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add
                                        to cart</a>
                                </div>
                                <a href="detail/${item.id}">
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2> ${item.price} </h2>
                                            <p>${item.name}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                      </div>`
                    });
                    $(".col-sm-9.padding-right .col-sm-4").remove();
                    $(".col-sm-9.padding-right.filler-price").append(html);

                    // console.log('products:', result.products);
                    // console.log('html:', html);
                }
            });
        })
    })
</script>

</html>
