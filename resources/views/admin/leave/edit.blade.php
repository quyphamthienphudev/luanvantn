<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { background-color: #f4f7f6; }
    .card { 
        border: none; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        overflow: hidden;
    }
    .card-header { 
        background: linear-gradient(45deg, #0d6efd, #004fb1); 
        border: none; 
        padding: 1.5rem;
    }
    .form-label { color: #495057; font-size: 0.9rem; }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
    .btn-save {
        background: #0d6efd;
        color: white;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }
    .btn-save:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    .btn-cancel {
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.app')

@section('content')
<a href="/admin/leave" class="btn btn-secondary">
    ← Quay lại
</a>
<h1 class="text-2xl font-bold mb-6">
Chỉnh sửa đơn xin nghỉ phép
</h1>

<form action="/admin/leave/update/{{ $leave->id }}" method="POST"
class="bg-white p-6 rounded shadow w-1/2">

@csrf
<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label fw-bold small text-uppercase">
            Mã nhân viên
        </label>
        <input type="text" name="employee_code" class="form-control shadow-sm" 
            value="{{ $leave->user->id ?? $leave->employee->employee_code }}" readonly>
    </div>              
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label fw-bold small text-uppercase">
            Ngày bắt đầu
        </label>
        <input type="date" name="start_date" class="form-control shadow-sm" 
            value="{{ $leave->start_date }}" required>
    </div>
                            
    <div class="col-md-6 mb-4">
        <label class="form-label fw-bold small text-uppercase">
            Ngày kết thúc
        </label>
        <input type="date" name="end_date" class="form-control shadow-sm" 
            value="{{ $leave->end_date }}" required>
    </div>              
</div>

<div class="mb-4">
    <label class="form-label fw-bold small text-uppercase">
        Lý do xin nghỉ phép
    </label>
    <textarea name="reason" class="form-control shadow-sm" rows="4" required>{{ $leave->reason }}</textarea>
</div>

<div class="d-flex flex-column flex-sm-row gap-3">
    <button type="submit" class="btn btn-save flex-grow-1">
        Lưu thay đổi
    </button>
</div>

<div class="text-left mt-4">
    <p class="text-muted small">
        <i class="fas fa-info-circle me-1"></i> 
        Lưu ý: Chỉ có thể sửa đơn xin nghỉ phép đang ở trạng thái <b>Chờ duyệt</b>.
    </p>
</div>

</form>

@endsection
