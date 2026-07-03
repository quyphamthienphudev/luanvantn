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
    <a href="/hcns/departments/create" class="bg-blue-600 text-white px-4 py-2 rounded" title="Thêm phòng ban">Thêm phòng ban</a>
    <a href="/hcns/departments/export" class="bg-yellow-600 text-white px-4 py-2 rounded" title="Xuất Excel">Xuất Excel</a>
    <form method="GET" action="/hcns/departments" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2"
            placeholder="Tìm theo tên phòng ban hoặc mô tả" style="width:300px;">
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
                    <th class="p-3">Tên phòng ban</th>
                    <th class="p-3">Mô tả thông tin</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $d)
                <tr class="border-b">
                    <td class="p-3">{{ $d->name }}</td>
                    <td class="p-3">{{ $d->description }}</td>
                    <td class="p-3 space-x-2">
                        <a href="/hcns/departments/edit/{{ $d->id }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded" title="Sửa">Sửa</a>
                        <a href="/hcns/departments/delete/{{ $d->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá phòng ban này ?')" title="Xoá">Xoá</a>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="3" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>

@endsection