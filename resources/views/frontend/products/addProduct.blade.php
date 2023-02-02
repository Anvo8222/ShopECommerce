<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
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
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
                <div class="row-input">
                    <label for="name">Name:</label>
                    <input type="text" name="name">
                </div>
                @error('name')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="price">Price:</label>
                    <input type="number" name="price">
                </div>
                @error('price')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="category">Choose a category:</label>
                    <select class="select" name="category">
                        <option value="">Category</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="brand">Choose a brand:</label>
                    <select class="select" name="brand">
                        <option value="">Brand</option>
                        @foreach ($brands as $brand)
                            <option value={{ $brand->id }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('brand')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input row-input_sl">
                    <label for="sale">Sale:</label>
                    <select class="select_sale" name="sale">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                @error('value_sale')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="company">Company:</label>
                    <input type="text" name="company">
                </div>
                @error('company')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="image">Select files:</label>
                    <input type="file" name="image[]" multiple><br><br>
                </div>
                @error('image')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <div class="row-input">
                    <label for="details">Detail:</label>
                    <textarea type="text" rows="5" name="details"></textarea>
                </div>
                @error('details')
                    <span style="color:Red">{{ $message }}</span> <br />
                @enderror
                <input style="background: orange; margin-top:10px " type="submit" value="Create Product">
            </form>
        </div>
    @endsection

</body>
@section('script')
    <script>
        $(document).ready(function() {
            // $(".select_sale").change(function() {
            //     var myvalue = $(this).val();
            //     if (myvalue == 1) {
            //         $('.row-input_sale').show();
            //     } else {
            //         $('.sale_number').val(" ");
            //         $('.row-input_sale').hide();
            //     }
            // });
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
