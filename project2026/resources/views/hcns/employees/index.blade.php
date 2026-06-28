@extends('layouts.app')

@section('title','Quản lý nhân viên')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý nhân viên</title>
</head>

<body>
    <a href="/hcns/employees/create" class="bg-blue-600 text-white px-4 py-2 rounded">
        Thêm nhân viên
    </a>
    <a href="/hcns/employees/export" class="bg-yellow-600 text-white px-4 py-2 rounded">
        Xuất Excel
    </a>

    <form method="GET" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2"
            placeholder="Tìm theo mã nhân viên, tên nhân viên hoặc phòng ban" style="width:450px;">
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
                    <th class="p-3">Mã nhân viên</th>
                    <th class="p-3">Họ tên nhân viên</th>
                    <th class="p-3">Phòng ban</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employees as $e)
                <tr class="border-b">
                    <td class="p-3">{{ $e->employee_code }}</td>
                    <td class="p-3">{{ $e->full_name }}</td>
                    <td class="p-3">{{ $e->department->name }}</td>
                    <td class="p-3 space-x-2">
                        <a href="/hcns/employees/show/{{ $e->id }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded">Xem</a>
                        <a href="/hcns/employees/edit/{{ $e->id }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
                        <a href="/hcns/employees/delete/{{ $e->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá nhân viên này ?')">Xóa</a>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>

@endsection