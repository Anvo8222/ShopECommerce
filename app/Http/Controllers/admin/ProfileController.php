<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Adm\CountryModel;

class ProfileController extends Controller
{
  public function __construct()
  {
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = auth::user();
    $countries = CountryModel::all();
    return view('adminFolder/profile/profile', compact('user', 'countries'));

    // $id = Auth::id();
    // $user = DB::table('users')->where('id', $id)->first();
    // dd($user);
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProfileRequest $request)
  {
    $userId = Auth::id();
    $user = User::findOrFail($userId);
    $data = $request->all();
    $file = $request->avatar;
    if (!empty($file)) {
      $data['avatar'] = $file->getClientOriginalName();
    }
    if ($data['password']) {
      $data['password'] = bcrypt($data['password']);
    } else {
      $data['password'] = $user->password;
    }

    // dd($data);
    if ($user->update($data)) {
      if (!empty($file)) {
        $file->move('upload/user/avatar', $file->getClientOriginalName());
      }
      return redirect()->back()->with('success', __('Update profile success.'));
    } else {
      return redirect()->back()->withErrors('Update profile error.');
    }

    // DB::table('users')->where('id', $userId)->update([
    //   "name" => $request->name,
    //   "phone" => $request->phone,
    //   // "password" => $request->pass,
    //   "address" => $request->address,
    // ]);
    // return redirect('/admin/profile');
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