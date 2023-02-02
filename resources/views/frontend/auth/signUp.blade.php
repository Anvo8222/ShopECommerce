@extends('frontend.layouts.app')

@section('content')
    <div class="col-sm-4">
        <div class="signup-form">
            <!--sign up form-->
            <h2>New User Signup!</h2>
            <form method="post" action="">
                @csrf
                <input type="text" name="name" placeholder="Name" />
                @error('name')
                    <p style="color:red">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="Email Address" />
                @error('email')
                    <p style="color:red">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="Password" />
                @error('password')
                    <p style="color:red">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-default">Signup</button>
                {{-- <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Sign Up" /> --}}
            </form>
        </div>
    </div>
@endsection
