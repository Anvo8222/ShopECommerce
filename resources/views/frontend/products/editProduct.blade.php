<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <style>
        .row-input {
            margin-top: 10px;
        }

        label {
            min-width: 130px;
        }

        input {
            width: 50%;
        }

        .select {
            width: 50%;
        }
    </style>
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        @include('frontend.layouts.leftSidebarAccount')
        <div class="col-sm-9">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="row-input">
                    <label for="name">Name:</label>
                    <input type="text" name="name" <?php echo 'value="' . $product->product_name . '"'; ?>>
                </div>
                {{-- @error('name')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="price">Price:</label>
                    <input type="number" name="price" value="{{ $product->price }}">
                </div>
                {{-- @error('price')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="category">Choose a category:</label>
                    <select class="select" name="category">
                        <option value="{{ $product->category_id }}">{{ $product->categorie_name }}</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- @error('category')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="brand">Choose a brand:</label>
                    <select class="select" name="brand">
                        <option value="{{ $product->brand_id }}">{{ $product->brand_name }}</option>
                        @foreach ($brands as $brand)
                            <option value={{ $brand->id }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- @error('brand')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input row-input_sl">
                    <label for="sale">Sale: {{ $product->sale }}</label>
                    <select class="select_sale" name="sale">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                {{-- @error('value_sale')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="company">Company:</label>
                    <input type="text" name="company" <?php echo 'value="' . $product->company . '"'; ?>>
                </div>
                {{-- @error('company')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="image">Select files:</label>
                    <input type="file" name="image[]" multiple><br><br>
                </div>
                <div style="display: flex;">
                    {{-- {{ dd($product->image) }} --}}
                    @foreach (json_decode($product->image) as $image)
                        <div style="display: flex; flex-direction: column; align-items: center">
                            <img style="width:50px; height:50px;"
                                src="{{ url('upload/product/' . $userId . '/' . $image) }}" alt="ewewe">
                            <input style="cursor: pointer" type="checkbox" name="image_item[]"
                                value="{{ $image }}"><br>
                        </div>
                    @endforeach
                </div>
                @if (session()->has('status_err'))
                    <span style="color:Red">{{ session()->get('status_err') }}</span> <br />
                @endif
                {{-- @error('image')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <div class="row-input">
                    <label for="details">Detail:</label>
                    <textarea type="text" rows="5" name="details">
                      {{ $product->detail }}
                    </textarea>
                </div>
                {{-- @error('details')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror --}}
                <input style="background: orange; margin-top:10px" type="submit" value="Update Product">
            </form>
        </div>
    @endsection
</body>
@section('script')
    <script>
        $(document).ready(function() {
            $(".select_sale").change(function() {
                let myvalue = $(this).val();
                let saleInput = "";
                let html = `<div class="
                    row_input row_input_sale "><input class="
                    sale_number" type="number" min="0" max="100" name="value_sale"><label>%</label></div>`
                if (myvalue == 1) {
                    $(".row-input_sl").append(html)
                } else {
                    $(".row_input_sale").remove();
                }
            });
        });
    </script>
@endsection

</html>
