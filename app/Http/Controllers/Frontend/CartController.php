<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cart = session()->get('cart', []);
    // dd($cart);
    return view('frontend/cart/cart', compact('cart'));
  }

  public function quantity_up()
  {
    $idProduct = $_POST['idProduct'];
    $totalItem = 0;
    $cart = session()->get('cart');
    for ($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]['idProduct'] == $idProduct) {
        $cart[$i]['quantityProduct'] = $cart[$i]['quantityProduct'] + 1;
        $totalItem += (float)$cart[$i]['priceProduct'] * (int)$cart[$i]['quantityProduct'];
        break;
      }
    };
    session()->put('cart', $cart);
    $quantity = totalCart();
    $totalAll = totalPriceAllCart();

    // session()->forget('user_name');
    return response()->json(['cart' => $cart, 'totalItem' => $totalItem, 'quantity' => $quantity, 'totalAll' => $totalAll]);
  }

  public function quantity_down()
  {
    $idProduct = $_POST['idProduct'];
    $totalItem = 0;
    $cart = session()->get('cart');
    for ($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]['idProduct'] == $idProduct) {
        if ($cart[$i]['quantityProduct'] <= 1) {
          unset($cart[$i]);
          $cart = array_values($cart);
        } else {
          $cart[$i]['quantityProduct'] = $cart[$i]['quantityProduct'] - 1;
          $totalItem += (float)$cart[$i]['priceProduct'] * (int)$cart[$i]['quantityProduct'];
        }
        break;
      }
    };
    session()->put('cart', $cart);
    $quantity = totalCart();
    $totalAll = totalPriceAllCart();
    return response()->json(['cart' => $cart, 'totalItem' => $totalItem, 'quantity' => $quantity, 'totalAll' => $totalAll]);
  }

  public function delete_item()
  {
    $idProduct = $_POST['idProduct'];
    $cart = session()->get('cart');
    for ($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]['idProduct'] == $idProduct) {
        unset($cart[$i]);
        break;
      }
    };
    //reset arr
    $cart = array_values($cart);
    session()->put('cart', $cart);
    $quantity = totalCart();
    $totalAll = totalPriceAllCart();

    return response()->json(['cart' => $cart, 'deleted' => true, 'quantity' => $quantity, 'totalAll' => $totalAll]);
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
    //
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