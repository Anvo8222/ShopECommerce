<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Frontend\CheckoutModel;
use Mail;
use App\Mail\MailNotify;
use App\Models\Frontend\UserModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\submitCartRequest;

class CheckoutController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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

  // public function testEmail()
  // {
  //   $name = "test email";
  //   Mail::send('emails.index', compact('name'), function ($email) {
  //     $email->to('puchipuchi8222@gmail.com', 'an test');
  //   });
  // }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CheckoutRequest $request)
  {
    $cart = session()->get('cart');
    $totalCart = totalPriceAllCart();
    $err = false;
    // dd($totalCart);
    $data = [
      'subject' => 'Nguyen An Mail',
      'body' => 'Tổng tiền sản phẩm',
      'price' => $totalCart,
      'address' => $request->address,
    ];
    try {
      Mail::to($request->email)->send(new MailNotify($data));
      if (!Auth::check()) {
        $user = new UserModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->save();
        $login = [
          'email' => $request->email,
          'password' => $request->password,
          'level' => 0
        ];
        if (Auth::attempt($login, true)) {
          $userId = Auth::id();
          $desCheckout = new CheckoutModel();
          $desCheckout->email = $request->email;
          $desCheckout->phone = $request->phone;
          $desCheckout->name = $request->name;
          $desCheckout->id_user = $userId;
          $desCheckout->price = $totalCart;
          $desCheckout->save();
        }
      }
      return response()->json(['Greate check your mail box!']);
    } catch (Exception $th) {
      $err = true;
      return response()->json(['Sorry Err!']);
    }
    // if (!$err) {

    // }
  }

  public function submitCart(submitCartRequest $request)
  {
    $totalCart = totalPriceAllCart();
    $data = [
      'subject' => 'Nguyen An Mail',
      'body' => 'Tổng tiền sản phẩm',
      'price' => $totalCart,
      'address' => $request->address,
    ];

    $user = Auth::user();
    $userId = Auth::id();

    try {
      Mail::to($user->email)->send(new MailNotify($data));
      $desCheckout = new CheckoutModel();
      $desCheckout->email = $user->email;
      $desCheckout->name = $user->name ? $user->name : "user";
      $desCheckout->phone = $request->phone ? $request->phone : 56789;
      $desCheckout->id_user = $userId;
      $desCheckout->price = $totalCart;
      $desCheckout->save();
      return response()->json(['Greate check your mail box!']);
    } catch (Exception $th) {
      return response()->json(['Sorry Err!']);
    }

    $user = Auth::user();
    $userId = Auth::id();
    $desCheckout = new CheckoutModel();
    $desCheckout->email = $user->email;
    $desCheckout->phone = $user->phone;
    $desCheckout->name = $request->name;
    $desCheckout->id_user = $userId;
    $desCheckout->price = $totalCart;
    $desCheckout->save();
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