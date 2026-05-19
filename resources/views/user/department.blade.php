@extends('layouts.app')

@section('title','Danh sách phòng ban')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý phòng ban</title>
</head>
<body>
    <a href="/departments/export" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Xuất file Excel</a>
    <form method="GET" action="/departments" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>
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