<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        <h2 class="title text-center">Features Items</h2>
        <form action="{{ route('show-list-fill') }}" method="post"
            style="display: flex; justify-content: space-evenly; margin-bottom:10px">
            @csrf
            <input type="name" name="name" placeholder="Name">
            <select style="margin: 0px 2px;" name="price">
                <option value="">Choose price</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="5000">5000</option>
            </select>
            <select style="margin: 0px 2px;" name="category">
                <option value="">Category</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <select style="margin: 0px 2px;" name="brand">
                <option value="">Brand</option>
                @foreach ($brands as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <select style="margin: 0px 2px;" name="status">
                <option value="">Status</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>
            <input type="submit" value="Search" style="background-color: blueviolet; color:chartreuse">
        </form>

        {{-- {{ dd($listItem) }} --}}
        <div class="col-sm-9 padding-right filler-price">
            @if ($listItem->isEmpty())
                <h1>Không có sản phẩm</h1>
            @else
                @foreach ($listItem as $item)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ url('upload/product/full/' . json_decode($item->image)[0]) }}"
                                        alt="{{ $item->name }}" />
                                    <h2>${{ $item->price }}</h2>
                                    <p>{{ $item->name }}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add
                                        to cart</a>
                                </div>
                                <a href="{{ route('product-detail', ['id' => $item->id]) }}">
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ $item->price }}</h2>
                                            <p>{{ $item->name }}</p>
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
            @endif
        </div>
    @endsection
</body>

</html>
