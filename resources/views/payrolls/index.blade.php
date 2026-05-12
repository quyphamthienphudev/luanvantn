@extends('layouts.app')

@section('title', 'Quản lý lương')

@section('content')
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
        @if(Auth::user()->role->name === 'admin')
        <form method="GET" action="/admin/payrolls" class="flex gap-2">
            <select name="month" class="border rounded px-3 py-2">
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                @endfor
            </select>
            <select name="year" class="border rounded px-3 py-2">
                @for($i = 2020; $i <= date('Y')+1; $i++)
                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Xem bảng lương</button>
        </form>
        @endif
        @if(Auth::user()->role->name === 'user')
        <form method="GET" action="/payrolls" class="flex gap-2">
            <select name="month" class="border rounded px-3 py-2">
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                @endfor
            </select>
            <select name="year" class="border rounded px-3 py-2">
                @for($i = 2020; $i <= date('Y')+1; $i++)
                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Xem bảng lương</button>
        </form>
        @endif
        <div class="flex gap-2">
            @if(Auth::user()->role->name === 'admin')
                <a href="/admin/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Tạo</a>
                <a href="/admin/payrolls/export" class="bg-yellow-500 text-white px-4 py-2 rounded">Xuất Excel</a>
            @else
                <a href="/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Tạo</a>
            @endif
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
                    <th class="border px-4 py-2">Tổng lương</th>
                    <th class="border px-4 py-2">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payrolls as $index => $payroll)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $payroll->employee_code ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $payroll->full_name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $payroll->department_name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $payroll->position_name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2 text-right">{{ number_format($payroll->base_salary ?? 0) }} VNĐ</td>
                    <td class="border px-4 py-2 text-right">{{ number_format($payroll->bonus ?? 0) }} VNĐ</td>
                    <td class="border px-4 py-2 text-right">{{ number_format($payroll->deduction ?? 0) }} VNĐ</td>
                    <td class="border px-4 py-2 text-right font-bold">{{ number_format($payroll->total_salary ?? 0) }} VNĐ</td>
                    <td class="border px-4 py-2 text-center">
                        @if(Auth::user()->role->name === 'admin')
                            <a href="/admin/payrolls/{{ $payroll->id }}" class="text-blue-500">Xem</a>
                            <a href="/admin/payrolls/edit/{{ $payroll->id }}" class="text-yellow-500 ml-2">Sửa</a>
                            <form action="/admin/payrolls/delete/{{ $payroll->id }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-red-500" onclick="return confirm('Bạn có muốn xóa bảng lương này ?')">Xóa</button>
                            </form>
                        @else
                            <a href="/payrolls/{{ $payroll->id }}" class="text-blue-500">Xem</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Chưa có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
