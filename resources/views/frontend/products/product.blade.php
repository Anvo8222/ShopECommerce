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
        @include('frontend.layouts.leftSidebarAccount')
        <div class="col-sm-9 padding-right">
            @if ($products->isEmpty())
                <h1>Không có sản phẩm</h1>
            @else
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img style="width:50px;height: 50px;"
                                    src="{{ url('upload/product/' . $userId . '/' . json_decode($product->image)[0]) }}" />
                            </td>
                            {{-- <td>{{ var_dump(json_decode($product->image, true)) }}</td> --}}
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{ route('edit-product', ['id' => $product->id]) }}">Edit</a><br />
                                <a href="{{ route('delete-product', ['id' => $product->id]) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ route('add-product') }}">Add Product</a>
            @endif
        </div>

    @endsection
</body>

</html>
