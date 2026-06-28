@extends('layouts.app')

@section('title','Quản lý kỷ luật')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý kỷ luật</title>
</head>

<body>
    <a href="/hcns/disciplines/create" class="bg-blue-600 text-white px-4 py-2 rounded">
        Thêm kỷ luật
    </a>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Tên nhân viên</th>
                    <th class="p-3">Nội dung kỷ luật</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($disciplines as $d)
                <tr class="border-b">
                    <td class="p-3">{{ $d->employee->full_name }}</td>
                    <td class="p-3">{{ $d->title }}</td>
                    <td class="p-3">{{ number_format($d->amount) }} VNĐ</td>
                    <td class="p-3">{{ $d->decision_date ? date('d/m/Y', strtotime($d->decision_date)) : '' }}</td>
                    <td class="p-3 space-x-2">
                        <a href="/hcns/disciplines/edit/{{ $d->id }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
                        <a href="/hcns/disciplines/delete/{{ $d->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá kỷ luật này ?')">Xóa</a>
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