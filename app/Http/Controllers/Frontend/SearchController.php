<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adm\BrandModel;
use App\Models\Adm\CategoryModel;
use Illuminate\Http\Request;
use App\Models\Frontend\ProductModel;

class SearchController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $listItem = ProductModel::all();
    $category = CategoryModel::all();
    $brands = BrandModel::all();
    return view('frontend/search/search', compact('listItem', 'category', 'brands'));
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
  public function showListFillPrice()
  {
    $priceMin = $_POST['priceMin'];
    $priceMax = $_POST['priceMax'];

    $products = ProductModel::whereBetween('price', [$priceMin, $priceMax])->get();
    return response()->json(['products' => $products]);
  }
  public function showListSearch(Request $request)
  {
    $category = CategoryModel::all();
    $brands = BrandModel::all();
    $listItem = [];
    if (!$request->value_search) {
      $listItem = ProductModel::all();
    } else {
      $listItem = ProductModel::where('name', 'LIKE', '%' . $request->value_search . '%')->get();
    }
    return view('frontend/search/search', compact('listItem', 'category', 'brands'));
  }
  public function showListFill(Request $request)
  {
    $category = CategoryModel::all();
    $brands = BrandModel::all();
    $q = ProductModel::all();
    // dd($request->all());
    if ($request->name) {
      $q = ProductModel::where('products.name', 'LIKE', '%' . $request->name . '%')->get();
    }
    if ($request->category) {
      $q = ProductModel::where('products.id_category', '=', (int)$request->category)->get();
    }
    if ($request->price) {
      $q = ProductModel::where('products.price', '<', (int)$request->price)->get();
    }
    if ($request->brand) {
      $q = ProductModel::where('products.id_brand', '=', (int)$request->brand)->get();
    }
    $listItem = $q;
    return view('frontend/search/search', compact('listItem', 'category', 'brands'));
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