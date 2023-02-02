<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\CommentModel;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $idBlog = $_POST['idBlog'];
    $value = $_POST['value'];
    $level = $_POST['level'];
    $id = Auth::id();
    $comment = new CommentModel();
    $comment->comment = $value;
    $comment->level = $level;
    $comment->id_blog = $idBlog;
    $comment->id_user = $id;
    $comment->save();
  }
  public function reply()
  {
    $idBlog = $_POST['idBlog'];
    $value = $_POST['value'];
    $idParent = $_POST['id_parent'];
    $id = Auth::id();
    $comment = new CommentModel();
    $comment->comment = $value;
    $comment->level = 1;
    $comment->id_blog = $idBlog;
    $comment->id_parent = $idParent;
    $comment->id_user = $id;
    $comment->save();
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
    // $comments = CommentModel::join("blogs", "blogs.id", '=', 'comment.id_blog')
    //   ->where('comment.id_blog', '=', $id)
    //   ->get();
    // return view('frontend/blogSingle', compact('comments'));
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