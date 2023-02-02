<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        <div hidden class="form_checkout">
            <div class="checkout-options">
                <h3>New User</h3>
                <p>Checkout options</p>
            </div>
            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div>
            <div class="shopper-informations">
                <div class="row">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        {{-- <form action="{{ route('cart-checkout') }}" method="post"> --}}
                        <form method="post" action="/fe/cart/checkout">
                            @csrf
                            <input type="text" name="name" placeholder="Name">
                            @error('name')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="email" name="email" value="" placeholder="email" value="">
                            @error('email')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password" placeholder="Password">
                            @error('password')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password_confirmation" placeholder="Confirm password">
                            @error('password_confirmation')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="text" name="address" placeholder="address">
                            @error('address')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="number" name="phone" placeholder="phone">
                            @error('phone')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input class="btn btn-primary" style="background-color: brown" type="submit" value="Continue">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div hidden class="form_address">
            <form action="/fe/cart/logined/checkout" method="post">
                @csrf
                <h2>Nhập địa chỉ</h2>
                <input type="text" name="address" placeholder="address">
                @error('address')
                    <p style="color:red">{{ $message }}</p>
                @enderror
                <input type="submit">
            </form>
        </div>
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Shopping Cart</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                    @if (empty($cart))
                        <h1>khong co cart</h1>
                    @else
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td class="total">Total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr class="item">
                                        <td class="cart_product" style="display:flex;justify-content: center;">
                                            <a href=""><img
                                                    src="{{ url('upload/product/' . $item['idUserProduct'] . '/' . $item['nameImageProduct']) }}"
                                                    style="width:70px; height: 70px;" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="">{{ $item['nameProduct'] }}</a></h4>
                                            <p>id product: <span id="id_product_{{ $item['idProduct'] }}"
                                                    class="id_product">{{ $item['idProduct'] }}</span></p>
                                        </td>
                                        <td class="cart_price">
                                            <p>$<span>{{ $item['priceProduct'] }}</span></p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <a class="cart_quantity_up" style="cursor: pointer;"> + </a>
                                                <input class="cart_quantity_input" type="text" name="quantity"
                                                    value="{{ $item['quantityProduct'] }}" autocomplete="off" disabled
                                                    size="2">
                                                <a class="cart_quantity_down" style="cursor: pointer;"> - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">
                                                ${{ $item['quantityProduct'] * $item['priceProduct'] }}</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a style="cursor: pointer;" class="cart_quantity_delete"><i
                                                    class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </section>
        <!--/#cart_items-->
        <section id="do_action">
            <div class="container">
                <div class="heading">
                    <h3>What would you like to do next?</h3>
                    <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                        delivery cost.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="chose_area">
                            <ul class="user_option">
                                <li>
                                    <input type="checkbox">
                                    <label>Use Coupon Code</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>Use Gift Voucher</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>Estimate Shipping & Taxes</label>
                                </li>
                            </ul>
                            <ul class="user_info">
                                <li class="single_field">
                                    <label>Country:</label>
                                    <select>
                                        <option>United States</option>
                                        <option>Bangladesh</option>
                                        <option>UK</option>
                                        <option>India</option>
                                        <option>Pakistan</option>
                                        <option>Ucrane</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>

                                </li>
                                <li class="single_field">
                                    <label>Region / State:</label>
                                    <select>
                                        <option>Select</option>
                                        <option>Dhaka</option>
                                        <option>London</option>
                                        <option>Dillih</option>
                                        <option>Lahore</option>
                                        <option>Alaska</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>

                                </li>
                                <li class="single_field zip-field">
                                    <label>Zip Code:</label>
                                    <input type="text">
                                </li>
                            </ul>
                            <a class="btn btn-default update" href="">Get Quotes</a>
                            <a class="btn btn-default check_out" href="">Continue</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Cart Sub Total <span>$59</span></li>
                                <li>Eco Tax <span>$2</span></li>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span class="total_all">$@if (Session::has('cart') != null)
                                            {{ totalPriceAllCart() }}
                                        @endif
                                    </span></li>
                            </ul>
                            <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#do_action-->
    @endsection
</body>
@section('script')
    <script>
        $(document).ready(function() {
            $('.cart_quantity_up').click(function(e) {
                e.preventDefault();
                let idProduct = $(this).closest('.item').find('.id_product').text();
                let quantityProduct = Number($(this).closest('.cart_quantity_button').find(
                        '.cart_quantity_input')
                    .val()) + 1;
                $(this).closest('.cart_quantity_button').find('.cart_quantity_input')
                    .val(quantityProduct)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/fe/cart/quantity_up',
                    type: 'post',
                    dataType: 'JSON',
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(result) {
                        console.log('cart:', result.cart);
                        console.log('totalItem:', result.totalItem);
                        $('#id_product_' + idProduct).closest('.item').find('.cart_total_price')
                            .text("$" + result.totalItem)
                        $('.cart_quantity').find('span').text('Cart ' + result.quantity)
                        $('.total_all').text(result.totalAll)
                    }
                });
            })
            //dau -
            $('.cart_quantity_down').click(function(e) {
                e.preventDefault();
                let idProduct = $(this).closest('.item').find('.id_product').text();
                let quantityProduct = Number($(this).closest('.cart_quantity_button').find(
                        '.cart_quantity_input')
                    .val()) - 1;
                $(this).closest('.cart_quantity_button').find('.cart_quantity_input')
                    .val(quantityProduct)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/fe/cart/quantity_down',
                    type: 'post',
                    dataType: 'JSON',
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(result) {
                        console.log('cart:', result.cart);
                        console.log('total:', result.totalItem);
                        let total = $('#id_product_' + idProduct).closest('.item').find(
                                '.cart_total_price')
                            .text("$" + result.totalItem)
                        if (total.text() == "$0") {
                            $('#id_product_' + idProduct).closest('.item').remove();
                        }
                        $('.cart_quantity').find('span').text('Cart ' + result.quantity)
                        $('.total_all').text(result.totalAll)
                    }
                });
            })
            //xoa
            $('.cart_quantity_delete').click(function(e) {
                e.preventDefault();
                let idProduct = $(this).closest('.item').find('.id_product').text();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/fe/cart/delete_item',
                    type: 'post',
                    dataType: 'JSON',
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(result) {
                        console.log('cart:', result.cart);
                        if (result.deleted == true) {
                            $('#id_product_' + idProduct).closest('.item').remove();
                        }
                        $('.cart_quantity').find('span').text('Cart ' + result.quantity)
                        $('.total_all').text(result.totalAll)
                    }
                });
            })

            //checkout
            $('.check_out').on('click', function(e) {
                e.preventDefault();
                const checkLogin = "{{ Auth::check() }}";
                if (checkLogin) {
                    $('.form_address').show();
                    $(window).scrollTop(100);

                } else {
                    $('.form_checkout').show();
                    $(window).scrollTop(100);
                }
            })
        })
    </script>
@endsection

</html>
