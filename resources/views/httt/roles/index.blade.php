@extends('layouts.app')
@section('title', 'Quản lý quyền truy cập')
@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm quyền truy cập</title>
</head>

<body>
    <div @class(['flex', 'space-x-2'])>
        <a href="/httt/roles/create" @class(['bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-700']) title="Thêm quyền truy cập">Thêm quyền truy cập</a>
    </div>
    <form action="/httt/roles" method="get"  @class(['mt-4'])>
        @csrf
        Tìm kiếm: <input type="text" name="search" value="{{ $search }}" @class(['border', 'p-2']) placeholder="Tìm theo tên quyền truy cập hoặc mô tả" style="width:400px;">
        <button @class(['bg-gray-500', 'text-white', 'px-3', 'py-2', 'rounded']) title="Tìm">Tìm</button>
    </form>
    @if(session('success'))
    <div @class(['bg-green-200', 'text-green-800', 'p-3', 'rounded', 'mt-4'])>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div @class(['bg-red-200', 'text-red-800', 'p-3', 'rounded', 'mt-4'])>
        {{ session('error') }}
    </div>
    @endif
    <div @class(['bg-white', 'shadow', 'rounded', 'mt-6'])>
        <table @class(['w-full', 'text-left'])>
            <thead @class(['bg-gray-200'])>
                <tr>
                    <th @class(['p-3'])>Tên quyền truy cập</th>
                    <th @class(['p-3'])>Mô tả</th>
                    <th @class(['p-3'])>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $r)
                <tr @class(['border-b'])>
                    <td @class(['p-3'])>{{ $r->name }}</td>
                    <td @class(['p-3'])>{{ $r->description }}</td>
                    <td @class(['flex', 'space-x-2', 'p-3'])>
                        <a href="/httt/roles/edit/{{ $r->id }}" @class(['bg-yellow-500', 'text-white', 'px-3', 'py-1', 'rounded']) title="Sửa">Sửa</a>
                        <form action="/httt/roles/delete/{{ $r->id }}" method="post">
                            @csrf
                            <button @class(['bg-red-600', 'text-white', 'px-3', 'py-1', 'rounded']) onclick="return confirm('Bạn có muốn xoá quyền truy cập này ?')" title="Xoá">Xoá</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr @class(['border-b'])>
                    <td colspan="3" @class(['text-center', 'py-10', 'text-gray-500'])>Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
@endsection