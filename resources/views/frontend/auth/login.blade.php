@extends('frontend.layouts.app')
@section('content')
    <section id="form">

        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Login to your account</h2>
                        <form action="" method="post">
                            @csrf
                            <input type="text" placeholder="Email" name="email" />
                            @error('email')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <input type="password" placeholder="Password" name="password" />
                            @error('password')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <span>
                                <input type="checkbox" class="checkbox" name="remember_me">
                                Keep me signed in
                            </span>
                            @error('err')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
            </div>
        </div>
    </section>
@endsection
