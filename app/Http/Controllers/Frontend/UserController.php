<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\UserModel;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Http\Requests\Frontend\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Frontend\CountryModel;
use App\Http\Requests\Frontend\UpdateUserRequest;
use PhpParser\Node\Expr\Cast\Double;


class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    // $user = auth::user();
    // $user = auth()->user();
    // print_r($user);
    return view('frontend/auth/login');
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
  public function login(LoginRequest $request)
  {
    $login = [
      'email' => $request->email,
      'password' => $request->password,
      'level' => 0
    ];
    $remember = false;
    if ($request->remember_me) {
      $remember = true;
    }
    if (Auth::attempt($login, $remember)) {
      // echo "login thanh cong!";
      // $user = auth()->user();
      // print_r($user);
      return redirect(route('blog-list'));
    } else {
      echo "login that bai!";
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect(route('blog-list'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(RegisterRequest $request)
  {
    //
    $user = new UserModel();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->level = 0;
    $user->save();
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    //

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    //
    $user = Auth::user();
    try {
      $nameCountry = CountryModel::findOrFail($user->id_country)->name;
    } catch (Throwable $th) {
      $nameCountry = "";
    }

    $countries = CountryModel::all();
    return view('frontend/profile/profile', compact('user', 'countries', 'nameCountry'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateUserRequest $request)
  {
    $userId = Auth::id();
    $user = UserModel::findOrFail($userId);
    $data = $request->all();
    $file = $request->avatar;
    if (!empty($file)) {
      $data['avatar'] = time() . $file->getClientOriginalName();
    }
    if ($data['password']) {
      $data['password'] = bcrypt($data['password']);
    } else {
      $data['password'] = $user->password;
    }
    if ($data['id_country'] == "none") {
      $data['id_country'] = (int)$user->id_country;
    } else {
      $data['id_country'] = $request->id_country;
    }
    if ($user->update($data)) {
      if (!empty($file)) {
        $file->move('upload/user/avatar', $data['avatar']);
      }
      return redirect()->back()->with('success', __('Update profile success.'));
    } else {
      return redirect()->back()->withErrors('Update profile error.');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}