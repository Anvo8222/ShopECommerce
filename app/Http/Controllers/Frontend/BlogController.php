<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\BlogModel;
use App\Models\Frontend\CommentModel;
use App\Models\Frontend\RateModel;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
  //
  public function index()
  {
    $blogs = BlogModel::orderBy('id', 'DESC')->paginate(3);
    $rates = BlogModel::join('rates', 'rates.id_blog', '=', 'blogs.id')->get(['point', 'id_blog']);
    // dd($rates);

    return view('frontend/blogs/blog', compact('blogs', 'rates'));
  }
  public function show($id)
  {
    $blog = BlogModel::findorfail($id);
    $previous = BlogModel::where('id', '<', $blog->id)->max('id');
    $next = BlogModel::where('id', '>', $blog->id)->min('id');
    //show comment of this blog
    // $comments = CommentModel::join("blogs", "comments.id_blog", '=', 'blogs.id')
    //   ->where('comments.id_blog', '=', $id)
    //   ->get(['comments.id', 'comment', 'level']);
    $comments = CommentModel::where('comments.id_blog', '=', $id)
      ->get();
    return view('frontend/blogs/blogSingle', compact('blog', 'comments', 'previous', 'next'));
  }

  public function store()
  {
    // $idBlog = $_POST['idBlog'];
    // $value = $_POST['value'];
    // $level = $_POST['level'];
    // $id = Auth::id();
    // $comment = new CommentModel();
  }
}