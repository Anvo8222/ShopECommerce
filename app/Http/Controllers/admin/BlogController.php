<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddBlogRequest;
use App\Http\Requests\EditBlogRequest;
use App\Models\Adm\BlogModel;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $blogs = BlogModel::all();
    return view('adminFolder/blogs/blogs', compact('blogs'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('adminFolder/blogs/addBlog');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddBlogRequest $request)
  {
    //
    $country = new BlogModel();
    $country->title = $request->title;
    $country->image = time() . $request->image->getClientOriginalName();
    $country->description = $request->description;
    $country->content = $request->content;
    if ($country->save()) {
      $request->image->move('upload/blog/image', $country->image);
      return redirect('/admin/blog');
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
    $blog = BlogModel::findOrFail($id);
    return view('adminFolder/blogs/editBlog', compact('blog'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(EditBlogRequest $request, $id)
  {
    $blog = BlogModel::findOrFail($id);
    $data = $request->all();
    $file = $request->image;
    if (!empty($file)) {
      $data['image'] = time() . $file->getClientOriginalName();
    }
    if ($blog->update($data)) {
      if (!empty($file)) {
        $file->move('upload/blog/image', $data['image']);
      }
      return redirect('/admin/blog');
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
    //
    BlogModel::where('id', $id)->delete();
    return redirect('/admin/blog');
  }
}