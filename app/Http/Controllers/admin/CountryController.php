<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adm\CountryModel;
use App\Http\Requests\AddCountryRequest;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $countries = CountryModel::all();
    return view('adminFolder/countries/countries', compact('countries'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('adminFolder/countries/addCountry');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddCountryRequest $request)
  {
    $country = new CountryModel();
    $country->name = $request->name;
    $country->save();
    return redirect('/admin/country');
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
    // $country = CountryModel::where('id', $id)->get();
    $country = CountryModel::findOrFail($id);
    return view('adminFolder/countries/editCountry', compact('country'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(AddCountryRequest $request, $id)
  {
    //
    $country = CountryModel::findOrFail($id);
    $country['name'] = $request->name;
    $country->save();
    return redirect('/admin/country');
    // return redirect()->back()->with('success', __('Update profile success.'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    CountryModel::where('id', $id)->delete();
    return redirect('/admin/country');
  }
}