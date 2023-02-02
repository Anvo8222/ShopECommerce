<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History</title>
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
                <th>email</th>
                <th>phone</th>
                <th>name</th>
                <th>id_user</th>
                <th>price</th>
            </tr>
            @foreach ($histories as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->id_user }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </table>
        {{-- <a href="/admin/country/add">Add Country</a> --}}
    @endsection
</body>

</html>
