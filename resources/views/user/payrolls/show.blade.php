@extends('layouts.app')

@section('title', 'Chi tiết bảng lương')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết bảng lương</title>
</head>
<body>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    @if(!$payroll)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            Không tìm thấy bảng lương!
        </div>
        <a href="/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded">Quay lại</a>
    @else
        <h2 class="text-xl font-bold mb-4">Chi tiết bảng lương</h2>
        <table class="w-full">
            <tr class="border-b">
                <th class="text-left py-2 w-1/3">Mã nhân viên</th>
                <td class="py-2">{{ $payroll->employee_code ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Họ tên</th>
                <td class="py-2">{{ $payroll->full_name ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Phòng ban</th>
                <td class="py-2">{{ $payroll->department_name ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Chức vụ</th>
                <td class="py-2">{{ $payroll->position_name ?? 'N/A' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Lương cơ bản</th>
                <td class="py-2">{{ number_format($payroll->base_salary ?? 0) }} VNĐ</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Thưởng</th>
                <td class="py-2">{{ number_format($payroll->bonus ?? 0) }} VNĐ</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Khấu trừ</th>
                <td class="py-2">{{ number_format($payroll->deduction ?? 0) }} VNĐ</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Tổng lương</th>
                <td class="py-2 font-bold">{{ number_format($payroll->total_salary ?? 0) }} VNĐ</td>
            </tr>
            <tr class="border-b">
                <th class="text-left py-2">Tháng</th>
                <td class="py-2">{{ $payroll->month }}</td>
             </tr>
            <tr class="border-b">
                <th class="text-left py-2">Năm</th>
                <td class="py-2">{{ $payroll->year }}</td>
             </tr>
        </table>
        <div class="mt-6">
            <a href="/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded">Quay lại</a>
        </div>
    @endif
    </div>
</body>
</html>

@endsection