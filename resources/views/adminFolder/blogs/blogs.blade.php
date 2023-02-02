<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <style>
        th,
        td {
            text-align: left;
            padding: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @extends('adminFolder.master')
    @section('content')
        <table>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    {{-- {{ $blog->image }} --}}
                    <td>
                        <img style="width:50px;height: 50px;" src="{{ url('/upload/blog/image/' . $blog->image) }}"
                            alt="ewfbdhjbhj">
                    </td>
                    <td>{{ $blog->description }}</td>
                    <td>
                        <a href="/admin/blog/edit/{{ $blog->id }}">Edit</a><br />
                        <a href="/admin/blog/delete/{{ $blog->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="/admin/blog/add">Add Blog</a>
    @endsection
</body>

</html>
