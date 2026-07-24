<title>Hệ thống quản lý nhân sự - Quản lý nghỉ phép</title>
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

@section('title', 'Quản lý nghỉ phép')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded mt-6">

    <table class="w-full text-left">

        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Nhân viên</th>
                <th class="p-3">Lý do nghỉ phép</th>
                <th class="p-3">Thời gian</th>
                <th class="p-3">Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>

        <tbody>
            @forelse($allLeaves as $leave)
            <tr class="border-b">
                <td class="ps-3">
                    <div class="fw-bold">{{ $leave->name ?? 'N/A' }}</div>
                    <small class="text-muted">Mã nhân viên: {{ $leave->employee_code }}</small>
                </td>
                <td class="ps-3">
                    <div>{{ $leave->reason }}</div>
                </td>
                <td class="ps-3">
                    <div class="small fw-bold text-dark">{{ $leave->start_date ? date('d/m/Y', strtotime($leave->start_date)) : '' }}</div>
                    <div class="small text-muted">đến {{ $leave->end_date ? date('d/m/Y', strtotime($leave->end_date)) : '' }}</div>
                </td>
                <td class="ps-3">
                    @if($leave->status == 'pending')
                    <span class="badge bg-warning text-dark status-badge">Chờ duyệt</span>
                    @elseif($leave->status == 'approved')
                    <span class="badge bg-success status-badge">Đã duyệt</span>
                    @else
                    <span class="badge bg-danger status-badge">Từ chối</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2 action-group ">

                        <a href="/hcns/leave/edit/{{ $leave->id }}">
                            <button class="btn btn-info btn-sm btn-action text-white" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>
                        
                        <form action="/hcns/leave/delete/{{ $leave->id }}" method="post" class="m-0 p-0">
                            @csrf 
                            <button class="btn btn-danger btn-sm btn-action" title="Xoá"
                            onclick="return confirm('Bạn có muốn xóa đơn xin nghỉ phép này?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
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

@endsection