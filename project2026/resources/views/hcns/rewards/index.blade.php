@extends('layouts.app')

@section('title','Quản lý khen thưởng')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý khen thưởng</title>
</head>

<body>
    <a href="/hcns/rewards/create" class="bg-blue-600 text-white px-4 py-2 rounded" title="Thêm khen thưởng">
        Thêm khen thưởng
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
                    <th class="p-3">Nội dung khen thưởng</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rewards as $r)
                <tr class="border-b">
                    <td class="p-3">{{ $r->employee->full_name }}</td>
                    <td class="p-3">{{ $r->title }}</td>
                    <td class="p-3">{{ number_format($r->amount) }} VNĐ</td>
                    <td class="p-3">{{ $r->decision_date ? date('d/m/Y', strtotime($r->decision_date)) : '' }}</td>
                    <td class="p-3 space-x-2">
                        <a href="/hcns/rewards/edit/{{ $r->id }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded" title="Sửa">Sửa</a>
                        <a href="/hcns/rewards/delete/{{ $r->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá khen thưởng này ?')" title="Xoá">Xoá</a>
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