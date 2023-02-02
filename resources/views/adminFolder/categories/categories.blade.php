<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
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
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="/admin/category/edit/{{ $category->id }}">Edit</a><br />
                        <a href="/admin/category/delete/{{ $category->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="/admin/category/add">Add Category</a>
    @endsection
</body>

</html>
