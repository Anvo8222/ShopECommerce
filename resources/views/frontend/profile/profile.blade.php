<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profile</title>
</head>

<body>
    @extends('frontend.layouts.app')
    @section('content')
        <div class="container">
            <div class="row">
                {{-- left --}}
                @include('frontend.layouts.leftSidebarAccount')
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <!--features_items-->
                        <h2 class="title text-center">User Update</h2>
                        <p>skdjskdhjlskhd</p>
                        <form method="post" enctype="multipart/form-data" action="{{ route('profile-update') }}">
                            @csrf
                            <label style="min-width: 70px" for="name">Name:</label>
                            <input style="width: 50%;" <?php echo "value='" . $user->name . "'"; ?> type="text" name="name"
                                placeholder="Name" /><br /><br />
                            @error('name')
                                <span style="color:Red">{{ $message }}</span> <br />
                            @enderror
                            <label style="min-width: 70px" for="email">Email:</label>
                            <input style="width: 50%;" disabled value="{{ $user->email }}" type="text" name="email"
                                placeholder="Email Address" /><br><br>
                            <label style="min-width: 70px" for="password">Password:</label>
                            <input style="width: 50%;" type="password" name="password" /><br><br>
                            @error('password')
                                <span style="color:Red">{{ $message }}</span> <br />
                            @enderror
                            <label style="min-width: 70px" for="address">City:</label>
                            <input style="width: 50%;" type="text" value="{{ $user->address }}" name="address" /><br><br>
                            @error('address')
                                <span style="color:Red">{{ $message }}</span> <br />
                            @enderror
                            <label style="min-width: 70px" for="phone">SĐT:</label>
                            <input style="width: 50%;" type="number" value="{{ $user->phone }}" name="phone" /><br><br>
                            @error('phone')
                                <span style="color:Red">{{ $message }}</span> <br />
                            @enderror
                            <label style="min-width: 70px" for="country">Country:</label>
                            <input style="width: 50%;" disabled type="text" value="{{ $nameCountry }}" /><br><br>
                            <select name="id_country" style="display: block;width: 50%;">
                                <option value="none">Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <div style="display:flex;">
                                <label style="min-width: 70px" for="avatar">Avatar: </label>
                                <input style="width: 50%;" type="file" name="avatar" /><br><br>
                            </div>
                            @error('avatar')
                                <span style="color:Red">{{ $message }}</span> <br />
                            @enderror
                            <input type="submit" name="submit" style="background-color: green;color:black; width: 50%;"
                                class="btn btn-default" value="Update" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
