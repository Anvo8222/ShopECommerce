@extends('adminFolder.master')
@section('content')
    <form action="" method="post">
        @csrf
        <p>Update Category</p>
        <input type="text" placeholder="name" name="name" <?php echo "value='" . $category->name . "'"; ?>>
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Update Category" />
    </form>
@endsection
