@extends('adminFolder.master')
@section('content')
    <form action="/admin/brand/add" method="post">
        @csrf
        <p>Create Brand</p>
        <input type="text" placeholder="name" name="name">
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Create Brand" />
    </form>
@endsection
