@extends('layouts.app')

@section('title','Quản lý hồ sơ ứng viên')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý hồ sơ ứng viên</title>
</head>
<body>
    <a href="/candidates/create" class="bg-blue-600 text-white px-4 py-2 rounded">
        Thêm hồ sơ ứng viên
    </a>
    <form method="GET" action="/candidates" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2" placeholder="Tìm theo mã hồ sơ hoặc họ tên" style="width:300px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã hồ sơ</th>
                    <th class="p-3">Họ tên</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
        <tbody>
        @foreach($candidates as $c)
            <tr class="border-b">
                <td class="p-3">{{ $c->candidate_id }}</td>
                <td class="p-3">{{ $c->full_name }}</td>
                <td class="p-3 space-x-2">
                    <a href="/candidates/show/{{ $c->id }}" class="bg-blue-500 text-white px-3 py-1 rounded">Xem</a>
                    <a href="/candidates/edit/{{ $c->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</body>
</html>

@endsection