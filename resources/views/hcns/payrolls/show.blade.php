@extends('layouts.app')
@section('title', 'Chi tiết bảng lương')
@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết bảng lương</title>
</head>

<body>
    <a href="/hcns/payrolls" @class(['btn', 'btn-secondary']) title="← Quay lại">← Quay lại</a>
    <div @class(['max-w-2xl', 'mx-auto', 'bg-white', 'rounded-lg', 'shadow', 'p-6'])>
        @if(!$payroll)
        <div @class(['bg-red-100', 'border', 'border-red-400', 'text-red-700', 'px-4', 'py-3', 'rounded', 'mb-4'])>
            Không tìm thấy bảng lương
        </div>
        @else
        <h2 @class(['text-xl', 'font-bold', 'mb-4'])>Chi tiết bảng lương</h2>
        <p><b>Thông tin chi tiết bảng lương dưới đây được tính theo công thức sau: </b></p>
        <br>
        <p>Lương tháng = (Lương cơ bản + Phụ cấp) / 26 * Số ngày làm việc thực tế</p>
        <br>
        <p>Lương thực lãnh = Lương tháng + Thưởng - Khấu trừ</p>
        <br>
        <table @class(['w-full'])>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2', 'w-1/3'])>Mã nhân viên</th>
                <td @class(['py-2'])>{{ $payroll->employee_code }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Họ tên</th>
                <td @class(['py-2'])>{{ $payroll->full_name }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Phòng ban</th>
                <td @class(['py-2'])>{{ $payroll->department_name }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Công việc</th>
                <td @class(['py-2'])>{{ $payroll->position_name }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Lương cơ bản</th>
                <td @class(['py-2'])>{{ number_format($payroll->base_salary ?? 0) }} VNĐ</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Phụ cấp</th>
                <td @class(['py-2'])>{{ number_format($payroll->allowance ?? 0) }} VNĐ</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Thưởng</th>
                <td @class(['py-2'])>{{ number_format($payroll->bonus ?? 0) }} VNĐ</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Khấu trừ</th>
                <td @class(['py-2'])>{{ number_format($payroll->deduction ?? 0) }} VNĐ</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Số ngày làm việc</th>
                <td @class(['py-2'])>{{ number_format($payroll->work_numbers ?? 0) }} ngày</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Tháng</th>
                <td @class(['py-2'])>{{ $payroll->month }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Năm</th>
                <td @class(['py-2'])>{{ $payroll->year }}</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Lương tháng</th>
                <td @class(['py-2'])>{{ number_format($payroll->month_salary ?? 0) }} VNĐ</td>
            </tr>
            <tr @class(['border-b'])>
                <th @class(['text-left', 'py-2'])>Lương thực lãnh</th>
                <td @class(['py-2', 'font-bold'])>{{ number_format($payroll->total_salary ?? 0) }} VNĐ</td>
            </tr>
        </table>
        @endif
    </div>
</body>
</html>
@endsection