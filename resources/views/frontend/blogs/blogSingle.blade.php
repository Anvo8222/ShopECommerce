<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        <div class="blog-post-area">
            <h2 class="title text-center">{{ $blog->title }}</h2>
            <input id="id_blog" hidden type="text" value="{{ $blog->id }}">
            <div class="single-blog-post">
                <h3>Girls Pink T Shirt arrived in store</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    {{-- <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </span> --}}
                </div>
                <a href="">
                    <img style="width:200px; height:200px; margin:0 auto"
                        src="{{ $blog->image ? url('upload/blog/image/' . $blog->image . ' ') : 'https://tse4.mm.bing.net/th?id=OIP.Ix6XjMbuCvoq3EQNgJoyEQHaFj&pid=Api&P=0' }}"
                        alt="">
                </a>
                <div>
                    {{ $blog->content }}
                </div>
                <div class="pager-area">
                    @if ($previous)
                        <a href="{{ URL::to('/fe/blogs/view/' . $previous) }}">Previous</a>
                    @endif
                    @if ($next)
                        <a href="{{ URL::to('/fe/blogs/view/' . $next) }}">Next</a>
                    @endif
                </div>
            </div>
        </div>
        {{-- {{ dd($comments) }} --}}

        <div class="response-area">
            <h2>3 RESPONSES</h2>
            <ul class="media-list">
                @foreach ($comments as $comment1)
                    @if ($comment1->level == 0)
                        <li id="{{ $comment1->id }}" class="media comment_item">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="images/blog/man-two.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p style="font-size:20px; color:rgb(48, 121, 238)">{{ $comment1->comment }}</p>
                                <button class="btn btn-primary reply"><i class="fa fa-reply"></i>Replay</button>
                                <form method="post" class="form-reply" action="{{ route('blog-reply') }}">
                                    @csrf
                                    <textarea class="text-reply" name="reply" rows="2"></textarea>
                                    <input type="submit" value="Post Reply"
                                        style="margin-top: 4px;background-color: aquamarine">
                                </form>
                            </div>
                        </li>
                    @endif
                    @foreach ($comments as $comment2)
                        @if ($comment2->level == 1 and $comment2->id_parent == $comment1->id)
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="images/blog/man-three.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <p>{{ $comment2->comment }}</p>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endforeach

            </ul>
        </div>

        <div class="replay-box">
            <div class="row">
                <form method="post" action="{{ route('blog-comment') }}" class="col-sm-12">
                    @csrf
                    <h2>Leave a replay</h2>
                    <div class="text-area">
                        <div class="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <textarea class="text-comment" name="message" rows="11"></textarea>
                        <p style="font-size:20px;color: red" class="err-comment"></p>
                        <button id="post-comment" class="btn btn-primary" href="">post comment</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</body>
@section('script')
    <script>
        $(document).ready(function() {
            const id_blog = $("#id_blog").val();
            const isLogin = "{{ Auth::check() }}";
            $("#post-comment").click(function(e) {
                e.preventDefault();
                const comment = $(".text-comment").val().trim();
                let err = false;
                let messageLogin = messageComment = "";
                if (!isLogin) {
                    err = true;
                    messageLogin = "Vui lòng login!";
                    alert(messageLogin);
                }
                if (!comment) {
                    err = true;
                    messageComment = "Vui lòng nhập!";
                    $('.err-comment').text(messageComment);
                }
                if (!err) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/fe/blogs/view/comment',
                        type: 'post',
                        dataType: 'JSON',
                        data: {
                            idBlog: id_blog,
                            value: comment,
                            level: 0
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });
                }
            })
            $(".form-reply").hide();
            $(".reply").click(function(e) {
                e.preventDefault();
                let idComment = $(this).closest(".comment_item").attr("id");
                $(this).closest(".media-body").find(".form-reply").show();
            })
            $(".form-reply").submit(function(e) {
                e.preventDefault();
                let err = false;
                let messageLogin = messageReply = "";
                let textReply = $(this).find(".text-reply").val().trim();
                let id_parent = $(this).closest(".comment_item").attr("id");
                if (!isLogin) {
                    err = true;
                    messageLogin = "vui lòng login";
                    alert(messageLogin);
                    if (!textReply) {
                        err = true;
                        messageReply = "vui lòng nhập!";
                    }
                }
                if (!err) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/fe/blogs/view/reply',
                        type: 'post',
                        dataType: 'JSON',
                        data: {
                            idBlog: id_blog,
                            value: textReply,
                            id_parent: id_parent,
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });
                    $(this).find(".text-reply").val(" ");
                }
            })
        });
    </script>
@endsection

</html>
