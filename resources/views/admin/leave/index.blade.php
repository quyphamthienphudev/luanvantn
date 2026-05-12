<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .table th { vertical-align: middle; }
    .status-badge { width: 100px; display: inline-block; text-align: center; }
    .action-group { white-space: nowrap; }
    .btn-action { width: 32px; height: 32px; padding: 0; line-height: 32px; border-radius: 6px; }
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
    @foreach($allLeaves as $leave)
                    <tr class="border-b">
                        <td class="ps-3">
                            <div class="fw-bold">{{ $leave->user->name ?? $leave->employee->full_name ?? 'N/A' }}</div>
                            <small class="text-muted">Mã nhân viên: {{ $leave->user->id ?? $leave->employee->employee_code }}</small>
                        </td>
                        <td class="ps-3">
                            <div>{{ $leave->reason }}</div>
                        </td>
                        <td class="ps-3">
                            <div class="small fw-bold text-dark">{{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y') }}</div>
                            <div class="small text-muted">đến {{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y') }}</div>
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
                                @if($leave->status == 'pending')
                                    <form action="/admin/leave/approve/{{ $leave->id }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        <button class="btn btn-success btn-sm btn-action" title="Duyệt"><i class="fas fa-check"></i></button>
                                    </form>

                                    <form action="/admin/leave/reject/{{ $leave->id }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Từ chối đơn nghỉ phép này ?')">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm btn-action" title="Từ chối"><i class="fas fa-ban"></i></button>
                                    </form>

                                    <a href="/admin/leave/edit/{{ $leave->id }}" class="btn btn-info btn-sm btn-action text-white" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif

                                <form action="/admin/leave/delete/{{ $leave->id }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Bạn có muốn xóa đơn xin nghỉ phép này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-action" title="Xóa"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
    @endforeach
</tbody>

</table>

</div>

@endsection