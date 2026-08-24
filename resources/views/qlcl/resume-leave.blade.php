<title>Hệ thống quản lý nhân sự - Xem số ngày nghỉ phép còn lại</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .table th {
        vertical-align: middle;
    }
    .status-badge {
        width: 100px;
        display: inline-block;
        text-align: center;
    }
    .action-group {
        white-space: nowrap;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        line-height: 32px;
        border-radius: 6px;
    }
</style>
@extends('layouts.app')
@section('title', 'Xem số ngày nghỉ phép còn lại')
@section('content')
<div @class(['flex', 'justify-between', 'items-center', 'mb-6'])>
    <h2 @class(['text-2xl', 'font-bold', 'text-gray-800'])>Danh sách nhân viên</h2>
</div>
<div @class(['bg-white', 'shadow', 'rounded', 'mt-6'])>
    <table @class(['w-full', 'text-left'])>
        <thead @class(['bg-gray-200'])>
            <tr>
                <th @class(['p-3'])>Nhân viên</th>
                <th @class(['p-3'])>Số ngày đã sử dụng</th>
                <th @class(['p-3'])>Số ngày còn lại</th>
                <th @class(['p-3'])>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @forelse($countResumeLeave as $c)
            <tr @class(['border-b'])>
                <td @class(['ps-3'])>
                    <div @class(['fw-bold'])>{{ $c->name ?? 'N/A' }}</div>
                    <small @class(['text-muted'])>Mã nhân viên: {{ $c->employee_code }}</small>
                </td>
                <td @class(['ps-3'])>
                    <div>{{ $c->number_days_used }} ngày</div>
                </td>
                <td @class(['ps-3'])>
                    <div>{{ $c->number_days_resume }} ngày</div>
                </td>
                <td @class(['ps-3'])>
                    @if($c->number_days_resume == 0)
                    <span @class(['badge', 'bg-danger', 'status-badge'])>Hết ngày nghỉ</span>
                    @else
                    <span @class(['badge', 'bg-success', 'status-badge'])>Còn ngày nghỉ</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr @class(['border-b'])>
                <td colspan="4" @class(['text-center', 'py-10', 'text-gray-500'])>Không có dữ liệu</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<br>
@endsection