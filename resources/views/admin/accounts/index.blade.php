@extends('layouts.app')

@section('title', 'Quản lý tài khoản')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm tài khoản</title>
</head>
<body>
    <a href="/admin/accounts/create"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Thêm tài khoản
    </a>
    <a href="/admin/accounts/export"
    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        Xuất file Excel
    </a>
    <form method="GET" action="/admin/accounts" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2">
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
                    <th class="p-3">STT</th>
                    <th class="p-3">Họ tên</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Quyền</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="p-3">{{ $user->id }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                    @if($user->role_id == '1')
                        <span class="bg-red-200 text-red-700 px-2 py-1 rounded text-sm">
                            Admin
                        </span>
                    @else
                        <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded text-sm">
                            User
                        </span>
                    @endif
                    </td>
                    <td class="p-3 space-x-2">
                        <a href="/admin/accounts/edit/{{ $user->id }}"
                        class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Sửa
                        </a>
                        <a href="/admin/accounts/delete/{{ $user->id }}"
                        class="bg-red-600 text-white px-3 py-1 rounded"
                        onclick="return confirm('Bạn có muốn xoá tài khoản này ?')">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

@endsection