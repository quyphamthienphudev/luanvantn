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
            <form method="GET" action="/hcns/payrolls" class="flex gap-2">
                <select name="month" class="border rounded px-3 py-2">
                    @for($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                    @endfor
                </select>
                <select name="year" class="border rounded px-3 py-2">
                    @for($i = 2001; $i <= 2099; $i++) <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                    @endfor
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Xem bảng lương</button>
            </form>
            <div class="flex gap-2">
                <a href="/hcns/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Tạo</a>
                <a href="/hcns/payrolls/export" class="bg-yellow-500 text-white px-4 py-2 rounded">Xuất Excel</a>
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
                        <th class="border px-4 py-2">Thưởng</th>
                        <th class="border px-4 py-2">Khấu trừ</th>
                        <th class="border px-4 py-2">Thuế thu nhập cá nhân</th>
                        <th class="border px-4 py-2">Lương thực lãnh</th>
                        <th class="border px-4 py-2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payrolls as $index => $p)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $p->employee_code ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $p->full_name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $p->department_name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $p->position_name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->base_salary ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->bonus ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($p->deduction ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right">{{ number_format(($p->base_salary + $p->bonus - $p->deduction) * 0.1 ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-right font-bold">{{ number_format($p->total_salary ?? 0) }} VNĐ</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="/hcns/payrolls/{{ $p->id }}" class="text-blue-500">Xem</a>
                            <a href="/hcns/payrolls/edit/{{ $p->id }}" class="text-yellow-500 ml-2">Sửa</a>
                            <form action="/hcns/payrolls/delete/{{ $p->id }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Bạn có muốn xóa bảng lương này ?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-10 text-gray-500">Chưa có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@endsection