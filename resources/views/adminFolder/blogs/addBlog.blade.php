@extends('adminFolder.master')
@section('content')
    <form style="display:block" action="" method="post" enctype="multipart/form-data">
        @csrf
        <p>Create Blog</p>
        <label for="title">Tile:</label>
        <input type="text" placeholder="Title" name="title"><br />
        @error('title')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <label for="image">Image:</label>
        <input type="file" name="image"><br />
        @error('image')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <span>Description</span><br />
        <textarea name="description" cols="80" rows="4"></textarea><br />
        @error('description')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <span>Content</span><br />
        <textarea name="content" cols="50" rows="4" class="form-control" id="content"></textarea>
        @error('content')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Create Country" />
    </form>
@endsection
