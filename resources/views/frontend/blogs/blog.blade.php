<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs</title>
    <style>
        .ratings_over {
            color: orange !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        {{-- {{ dd($blogs) }} --}}
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            {{-- {{ dd($rates) }} --}}
            @foreach ($blogs as $blog)
                <h1>{{ $blog->id }}</h1>
                <a href="/fe/blogs/view/{{ $blog->id }}">
                    <h3>{{ $blog->title }}</h3>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> Mac Doe</li>
                            <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>
                </a>
                <span>
                    <form action="{{ route('blog-rate') }}" id="{{ $blog->id }}" class="rating_group" method="post">
                        @csrf
                        <i style="color:black" class="ratings_stars fa fa-star"><input value="1" type="hidden"></i>
                        <i style="color:black" class="ratings_stars fa fa-star"><input value="2" type="hidden"></i>
                        <i style="color:black" class="ratings_stars fa fa-star"><input value="3" type="hidden"></i>
                        <i style="color:black" class="ratings_stars fa fa-star"><input value="4" type="hidden"></i>
                        <i style="color:black" class="ratings_stars fa fa-star"><input value="5" type="hidden"></i>
                        {{-- <input type="submit" value="go to "> --}}
                    </form>
                    <span>
                        <?php
                        $sum = 0;
                        $item = 0;
                        foreach ($rates as $rate) {
                            if ($rate->id_blog == $blog->id) {
                                $sum += $rate->point;
                                $item++;
                            }
                        }
                        if ($sum) {
                            echo $sum / $item;
                        }
                        
                        ?>
                    </span>
                </span>
        </div>
        <a href="">
            <img style="width:200px;height: 200px;"
                src="{{ $blog->image ? url('upload/blog/image/' . $blog->image . ' ') : 'https://tse4.mm.bing.net/th?id=OIP.Ix6XjMbuCvoq3EQNgJoyEQHaFj&pid=Api&P=0' }}"
                alt="weeewe">
        </a>
        <p>{{ $blog->description }}</p>
        <a class="btn btn-primary" href="/fe/blogs/view/{{ $blog->id }}">Read More</a>
        @endforeach
        </div>
        {{ $blogs->links('pagination::bootstrap-4') }}
        {{-- {{ $blogs->links() }} --}}
    @endsection
</body>
@section('script')
    <script>
        $(document).ready(function() {
            $('.ratings_stars').hover(
                function() {
                    // $(this).prevAll().andSelf().addClass('ratings_hover');
                    $(this).prevAll().andSelf().css('color', 'orange');
                },
                function() {
                    $(this).prevAll().andSelf().css('color', 'black');
                }
            );
            $('.ratings_stars').click(function(e) {
                e.preventDefault();
                var value = $(this).find("input").val();
                if ($(this).hasClass('ratings_over')) {
                    $('.ratings_stars').removeClass('ratings_over');
                    $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }
                const idBlog = $(this).closest('.rating_group').attr('id');
                const url = $(this).closest('.rating_group').attr('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var checkLogin = "{{ Auth::check() }}";
                console.log("checkLogin", checkLogin);
                if (checkLogin) {
                    $.ajax({
                        url: $(this).closest('.rating_group').attr('action'),
                        type: 'post',
                        dataType: 'JSON',
                        data: {
                            idBlog: idBlog,
                            value: value,
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });
                } else {
                    alert('chua login')
                }

            });
        });
    </script>
@endsection

</html>
