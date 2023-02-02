<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\ProductModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\AddProductRequest;
use App\Models\Frontend\CategoryModel;
use App\Models\Frontend\BrandModel;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $userId = Auth::id();
    // $products = ProductModel::all();
    $products = ProductModel::where('id_user', $userId)->get();
    return view('frontend/products/product', compact("products", "userId"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $categories = CategoryModel::all();
    $brands = BrandModel::all();
    return view('frontend/products/addProduct', compact('categories', 'brands'));
  }

  protected function moveImage($userId, $request)
  {
    foreach ($request->file('image') as $image) {
      $name = "full_" . $image->getClientOriginalName();
      $name_2 = "hinh50_" . $image->getClientOriginalName();
      $name_3 = "hinh200_" . $image->getClientOriginalName();
      // $image->move('upload/product/full/', $name);
      Image::make($image)->save(public_path('upload/product/full/' . $name));

      if (!file_exists('upload/product/' . $userId)) {
        mkdir('upload/product/' . $userId, 0700);
      }
      $path = public_path('upload/product/' . $userId . '/' . $name);
      $path2 = public_path('upload/product/' . $userId . '/' . $name_2);
      $path3 = public_path('upload/product/' . $userId . '/' . $name_3);
      Image::make($image)->save($path);
      Image::make($image)->resize(50, 70)->save($path2);
      Image::make($image)->resize(200, 300)->save($path3);
    }
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddProductRequest $request)
  {
    $userId = Auth::id();
    $data = [];
    if ($request->hasfile('image')) {
      $this->moveImage($userId, $request);
      foreach ($request->file('image') as $image) {
        $name = "full_" . $image->getClientOriginalName();
        $data[] = $name;
      }
      $product = new ProductModel();
      $product->name = $request->name;
      $product->price = $request->price;
      $product->id_category = $request->category;
      $product->id_brand = $request->brand;
      $product->sale = 0;
      if ($request->sale == 1) {
        $product->sale = $request->value_sale;
      }
      $product->company = $request->company;
      $product->detail = $request->details;
      $product->image = json_encode($data);
      $product->id_user = $userId;
      $product->save();
      return redirect('/fe/account/product');
    }
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
    $userId = Auth::id();
    $categories = CategoryModel::all();
    $brands = BrandModel::all();
    // $product = ProductModel::findOrFail($id);
    $product = ProductModel::join('categories', 'products.id_category', '=', 'categories.id')
      ->join('brands', 'products.id_brand', '=', 'brands.id')
      ->where('products.id', '=', $id)
      ->select(
        'products.name as product_name',
        'products.price',
        'products.sale',
        'products.company',
        'products.image',
        'products.detail',
        'categories.id as category_id',
        'brands.id as brand_id',
        'categories.name as categorie_name',
        'brands.name as brand_name',
      )
      ->first();
    // dd($product);
    return view('frontend/products/editProduct', compact("product", "categories", "brands", "userId"));
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
    $listImage = ProductModel::findOrFail($id);
    $newListImage = json_decode($listImage->image);
    $listImageDelete = [];
    $arr = [];
    $data = [];
    $userId = Auth::id();
    $err = false;
    if ($request->image_item) {
      $listImageDelete = $request->image_item;
    }
    for ($i = 0; $i < count($newListImage); $i++) {
      if (!in_array($newListImage[$i], $listImageDelete)) {
        array_push($arr, $newListImage[$i]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $image) {
        $name = "full_" . $image->getClientOriginalName();
        $data[] = $name;
      }
    }
    $newListImage = array_merge($data, $arr);
    if (count($newListImage) > 3) {
      $err = true;
      return back()->with('status_err', 'Ảnh không được vượt quá 3, hãy tích để xoá!');
    } else if (count($data) > 0) {
      $this->moveImage($userId, $request);
    }
    if (!$err) {
      $product = ProductModel::findOrFail($id);
      $product['name'] = $request->name;
      $product['price'] = $request->price;
      $product['id_category'] = $request->category;
      $product['id_brand'] = $request->brand;
      $product['sale'] = 0;
      if ($request->sale == 1) {
        $product['sale'] = $request->value_sale;
      }
      $product['company'] = $request->company;
      $product['detail'] = $request->details;
      $product['image'] = json_encode($newListImage);
      $product['id_user'] = $userId;
      $product->update();
      return redirect('/fe/account/product');
      // dd($request->all());
      // dd($arr);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $userId = Auth::id();
    ProductModel::where([
      ['id', $id],
      ['id_user', $userId]
    ])->delete();
  }
}