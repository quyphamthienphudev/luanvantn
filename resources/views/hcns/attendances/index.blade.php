@extends('layouts.app')

@section('title', 'Quản lý chấm công')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý chấm công</title>
</head>

<body>
    <div class="max-w-6xl mx-auto mt-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Danh sách chấm công nhân viên</h2>
        </div>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3">Nhân viên</th>
                        <th class="p-3">Ngày</th>
                        <th class="p-3">Giờ vào</th>
                        <th class="p-3">Giờ ra</th>
                        <th class="p-3">Trạng thái</th>
                        <th class="p-3">Xác nhận</th>
                        <th class="p-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $atd)
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="p-3">
                            <p class="font-bold text-gray-800">{{ $atd->name ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">Mã nhân viên: {{ $atd->employee_code }}</p>
                        </td>
                        <td class="p-3">{{ $atd->work_date ? date('d/m/Y', strtotime($atd->work_date)) : '' }}</td>
                        <td class="p-3 font-medium">{{ $atd->check_in ?? 'Chưa có dữ liệu' }}</td>
                        <td class="p-3 font-medium">{{ $atd->check_out ?? 'Chưa có dữ liệu' }}</td>
                        <td class="p-3">
                            <span
                                class="px-2 py-1 rounded text-xs {{ $atd->status == 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                @if($atd->status == 'present')
                                Đúng giờ
                                @endif
                                @if($atd->status == 'late')
                                Đi trễ
                                @endif
                                @if($atd->status == 'absent')
                                Vắng mặt
                                @endif
                            </span>
                        </td>
                        <td class="p-3">{{ $atd->confirm=='yes' ? 'Đã xác nhận' : 'Chưa xác nhận' }}</td>
                        <td class="p-3 text-center">
                            <div class="flex space-x-2">
                                <a href="/hcns/attendances/edit/{{ $atd->id }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded" title="Sửa">Sửa</a>
                                <a href="/hcns/attendances/delete/{{ $atd->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Bạn có muốn xóa bảng chấm công này?')" title="Xoá">Xoá</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="hover:bg-gray-50 border-b">
                        <td colspan="7" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@endsection