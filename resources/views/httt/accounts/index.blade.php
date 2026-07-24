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
    <div class="flex space-x-2">
        <a href="/httt/accounts/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Thêm tài khoản">
            Thêm tài khoản
            </a>
        <form action="/httt/accounts/export" method="post">
            @csrf
            <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700" title="Xuất Excel">
            Xuất Excel
            </button>
        </form>
    </div>
    <form action="/httt/accounts" method="get" class="mt-4">
        @csrf
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2"
            placeholder="Tìm theo họ tên hoặc email" style="width:250px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded" title="Tìm">Tìm</button>
    </form>
    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-200 text-red-800 p-3 rounded mt-4">
        {{ session('error') }}
    </div>
    @endif
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Họ tên</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Quyền</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr class="border-b">
                    <td class="p-3">{{ $u->name }}</td>
                    <td class="p-3">{{ $u->email }}</td>
                    <td class="p-3">
                        @if($u->role_id == '1')
                        Ban giám đốc
                        @endif
                        @if($u->role_id == '2')
                        Phòng hành chính nhân sự
                        @endif
                        @if($u->role_id == '3')
                        Phòng quản lý chất lượng
                        @endif
                        @if($u->role_id == '4')
                        Phòng hệ thống thông tin
                        @endif
                        @if($u->role_id == '5')
                        Nhân viên
                        @endif
                    </td>
                    <td class="p-3">
                        <div class="flex space-x-2" style="width:150px;">
                            @if($u->status == 'active')
                            <span class="bg-green-200 text-green-700 px-2 py-1 rounded text-sm">
                                Đang hoạt động
                            </span>
                            @elseif($u->status == 'suspend')
                            <span class="bg-red-200 text-red-700 px-2 py-1 rounded text-sm">
                                Tạm dừng
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="flex space-x-2 p-5">
                        <a href="/httt/accounts/edit/{{ $u->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded"
                             title="Sửa">
                            Sửa
                            </a>
                        <form action="/httt/accounts/delete/{{ $u->id }}" method="post">
                            @csrf 
                            <button class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá tài khoản này ?')" title="Xoá">
                            Xoá
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="5" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>

@endsection