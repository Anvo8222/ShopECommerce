@extends('adminFolder.master')
@section('content')
    <form action="" method="post">
        @csrf
        <p>Create Category</p>
        <input type="text" placeholder="name" name="name">
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Create Country" />
    </form>
@endsection
