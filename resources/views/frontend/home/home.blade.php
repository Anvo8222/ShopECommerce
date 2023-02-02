<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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
            <div class="features_items">
                <!--features_items-->
                <h2 class="title text-center">Features Items</h2>
                @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ url('upload/product/full/' . json_decode($product->image)[0]) }}"
                                        alt="{{ $product->name }}" />
                                    <h2>${{ $product->price }}</h2>
                                    <p>{{ $product->name }}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add
                                        to cart</a>
                                </div>
                                <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ $product->price }}</h2>
                                            <p>{{ $product->name }}</p>
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
                    </div>
                @endforeach
            </div>
            <!--features_items-->
        </div>
    @endsection
</body>
{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.slider-track').click(function() {
                let value = $('.changePrice').val().split(",");
                let priceMin = value[0];
                let priceMax = value[1];
                console.log("jskdhjsg");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'fe/search_fill_price',
                    type: 'post',
                    dataType: 'JSON',
                    data: {
                        priceMin: priceMin,
                        priceMax: priceMax,
                    },
                    success: function(result) {
                        console.log('priceMin:', result.priceMin);
                        console.log('priceMax:', result.priceMax);
                    }
                });
            })

        })
    </script>
@endsection --}}

</html>
