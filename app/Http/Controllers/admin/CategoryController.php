<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adm\CategoryModel;
use App\Http\Requests\Adm\AddCategoryRequest;
use App\Http\Requests\Adm\UpdateCategoryRequest;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $categories = CategoryModel::all();
    return view('adminFolder/categories/categories', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view('adminFolder/categories/addCategory');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddCategoryRequest $request)
  {
    //
    $category = new CategoryModel();
    $category->name = $request->name;
    if ($category->save()) {
      return redirect('/admin/category');
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
    //

    $category = CategoryModel::findOrFail($id);
    return view('adminFolder/categories/editCategory', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCategoryRequest $request, $id)
  {
    //
    $category = CategoryModel::findOrFail($id);
    $category['name'] = $request->name;
    $category->update();
    return redirect('/admin/category');
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
    CategoryModel::where('id', $id)->delete();
    return redirect('/admin/category');
  }
}