@extends('layouts.app')

@section('title', 'Quản lý lương')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý lương</title>
</head>

<body>
    <div class="bg-white rounded-lg shadow p-6">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif
        <div class="mb-6 flex justify-between items-center">
            <form action="/hcns/payrolls" method="get" class="flex gap-2">
                @csrf
                <select name="month" class="border rounded px-3 py-2">
                    @for($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                    @endfor
                </select>
                <select name="year" class="border rounded px-3 py-2">
                    @for($i = 2001; $i <= 2099; $i++) <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                    @endfor
                </select>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" title="Xem bảng lương">Xem bảng lương</button>
            </form>
            <div class="flex gap-2">
                <a href="/hcns/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded" title="+ Tạo">+ Tạo</a>
                <form action="/hcns/payrolls/export" method="post">
                    @csrf
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded" title="Xuất Excel">Xuất Excel</button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">STT</th>
                        <th class="border px-4 py-2">Mã nhân viên</th>
                        <th class="border px-4 py-2">Họ tên</th>
                        <th class="border px-4 py-2">Phòng ban</th>
                        <th class="border px-4 py-2">Chức vụ</th>
                        <th class="border px-4 py-2">Lương cơ bản</th>
                        <th class="border px-4 py-2">Phụ cấp</th>
                        <th class="border px-4 py-2">Thưởng</th>
                        <th class="border px-4 py-2">Khấu trừ</th>
                        <th class="border px-4 py-2">Lương thực lãnh</th>
                        <th class="border px-4 py-2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payrolls as $index => $p)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $p->employee_code }}</td>
                        <td class="border px-4 py-2">{{ $p->full_name }}</td>
                        <td class="border px-4 py-2">{{ $p->department_name }}</td>
                        <td class="border px-4 py-2">{{ $p->position_name }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->base_salary ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->allowance ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->bonus ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->deduction ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right font-bold">{{ number_format($p->total_salary ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-center">
                            <div class="flex space-x-2">
                                <form action="/hcns/payrolls/{{ $p->id }}" method="post">
                                    @csrf 
                                    <button class="bg-blue-500 text-white px-3 py-1 rounded" title="Xem">Xem</button>
                                </form>
                                <a href="/hcns/payrolls/edit/{{ $p->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded" title="Sửa">Sửa</a>
                                <form action="/hcns/payrolls/delete/{{ $p->id }}" method="post">
                                    @csrf 
                                    <button class="bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Bạn có muốn xóa bảng lương này ?')" title="Xoá">Xoá</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

@endsection