<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Frontend\RateModel;


class RateController extends Controller
{
    //
    public function store()
    {
        $idBlog = $_POST['idBlog'];
        $value = $_POST['value'];
        $id = Auth::id();
        $rating = new RateModel();
        $rating->point = $value;
        $rating->user_id = $id;
        $rating->id_blog = $idBlog;
        $rating->save();
    }
}