@extends('layouts.app')

@section('title','Danh sách phòng ban')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Xem danh sách phòng ban</title>
</head>
<body>
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Tên phòng ban</th>
                    <th class="p-3">Mô tả thông tin</th>
                </tr>
            </thead>
        <tbody>
        @foreach($departments as $d)
            <tr class="border-b">
                <td class="p-3">{{ $d->name }}</td>
                <td class="p-3">{{ $d->description }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</body>
</html>

@endsection