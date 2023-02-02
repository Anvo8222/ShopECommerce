@extends('adminFolder.master')
@section('content')
    <form action="" method="post">
        {{-- {{ dd($country) }} --}}
        @csrf
        <p>Update Country</p>
        <input type="text" placeholder="name" name="name" <?php echo "value='" . $country->name . "'"; ?>>
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <input style="cursor: pointer; display:block; margin-top:10px;" type="submit" value="Update Country" />
    </form>
@endsection
