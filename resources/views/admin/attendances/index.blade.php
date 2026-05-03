@extends('layouts.app')

@section('title', 'Quản lý chấm công')

@section('content')
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
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $atd)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="p-3">
                        <p class="font-bold text-gray-800">{{ $atd->employee?->full_name ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500">Mã nhân viên: {{ $atd->employee?->employee_code }}</p>
                    </td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($atd->work_date)->format('d/m/Y') }}</td>
                    <td class="p-3 font-medium">{{ $atd->check_in ?? 'Chưa có dữ liệu' }}</td>
                    <td class="p-3 font-medium">{{ $atd->check_out ?? 'Chưa có dữ liệu' }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs {{ $atd->status == 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $atd->status }}
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <div class="flex space-x-2">
                            <a href="/admin/attendances/edit/{{ $atd->id }}" class="text-yellow-600 hover:underline">Sửa</a>
                            <a href="/admin/attendances/delete/{{ $atd->id }}" class="text-red-500 hover:underline" onclick="return confirm('Bạn có muốn xóa bảng chấm công này?')">Xóa</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
