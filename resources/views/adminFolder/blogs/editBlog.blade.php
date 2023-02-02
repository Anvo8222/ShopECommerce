@extends('adminFolder.master')
@section('content')
    <form style="display:block" action="" method="post" enctype="multipart/form-data">
        @csrf
        <p>Update Blog</p>
        <label for="title">Tile:</label>
        <input type="text" placeholder="Title" name="title" <?php echo 'value="' . $blog->title . '"'; ?>><br />
        @error('title')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <label for="image">Image:</label>
        <input type="file" name="image"><br />
        <span>Description</span><br />
        <textarea id="myTextArea" wrap="virtual" style="white-space: normal" name="description" cols="80" rows="4">
          {{ $blog->description }}
        </textarea>
        <br />
        @error('description')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <span>Content</span><br />
        <textarea name="content" cols="50" rows="4" class="form-control" id="content">{{ $blog->content }}</textarea>
        @error('content')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Update" />
    </form>
@endsection
