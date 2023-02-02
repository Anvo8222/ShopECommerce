<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adm\BrandModel;
use Illuminate\Http\Request;
use App\Models\Frontend\HomeModel;
use App\Models\Frontend\ProductModel;

class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $products = HomeModel::orderByDesc('created_at')->limit(6)->get();
    return view('frontend/home/home', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $product = HomeModel::findOrFail($id);
    $brandName = BrandModel::where('id', $product->id_brand)->select('name')->first()->name;
    return view('frontend/home/detail', compact('product', 'brandName'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  public function addToCart()
  {
    $idUserProduct = ProductModel::Where('id', $_POST['idProduct'])->select('id_user')->first()->id_user;
    $product = [
      'idProduct' => $_POST['idProduct'],
      'nameProduct' => $_POST['nameProduct'],
      'priceProduct' => $_POST['priceProduct'],
      'quantityProduct' => $_POST['quantityProduct'],
      'nameImageProduct' => $_POST['nameImageProduct'],
      'idUserProduct' => $idUserProduct,
    ];

    $cart = session()->get('cart', []);

    $isProductInCart = false;
    for ($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]['idProduct'] == $product['idProduct']) {
        $isProductInCart = true;
        $cart[$i]['quantityProduct'] = $cart[$i]['quantityProduct'] + $product['quantityProduct'];
        break;
      }
    };
    if (!$isProductInCart) {
      $cart[] = $product;
    };
    session()->put('cart', $cart);
    // // $quantity = 0;
    // // foreach ($cart as $key) {
    // //   $quantity += $key['quantityProduct'];
    // // }
    // //session()->forget('cart');
    $quantity = totalCart();
    return response()->json(['quantity' => $quantity, 'cart' => $cart]);
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}