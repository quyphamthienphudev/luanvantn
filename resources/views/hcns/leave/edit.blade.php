<title>Hệ thống quản lý nhân sự - Chỉnh sửa đơn xin nghỉ phép</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    body {
        background-color: #f4f7f6;
    }
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .card-header {
        background: linear-gradient(45deg, #0d6efd, #004fb1);
        border: none;
        padding: 1.5rem;
    }
    .form-label {
        color: #495057;
        font-size: 0.9rem;
    }
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }
    .form-control:focus,
    .form-select:focus {
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@extends('layouts.app')
@section('content')
<a href="/hcns/leave" @class(['btn', 'btn-secondary']) title="← Quay lại">← Quay lại</a>
<h1 @class(['text-2xl', 'font-bold', 'mb-6'])>Chỉnh sửa đơn xin nghỉ phép</h1>
<form action="/hcns/leave/update/{{ $leave->id }}" method="post" @class(['bg-white', 'p-6', 'rounded', 'shadow', 'w-1/2'])>
    @csrf
    <div @class(['row'])>
        <div @class(['col-md-6', 'mb-4'])>
            <label @class(['form-label', 'fw-bold', 'small'])>Mã nhân viên</label>
            <input type="text" @class(['form-control', 'shadow-sm', 'bg-gray-100']) value="{{ $leave->employee_code }}" readonly>
        </div>
        <div @class(['col-md-6', 'mb-4'])>
            <label @class(['form-label', 'fw-bold', 'small'])>Tên nhân viên</label>
            <input type="text" @class(['form-control', 'shadow-sm', 'bg-gray-100']) value="{{ $leave->name }}" readonly>
        </div>              
    </div>
    <div @class(['row'])>
        <div @class(['col-md-6', 'mb-4'])>
            <label @class(['form-label', 'fw-bold', 'small'])>Ngày bắt đầu</label>
            <input type="date" name="start_date" @class(['form-control', 'shadow-sm']) value="{{ old('start_date', $leave->start_date) }}">
            @error('start_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['col-md-6', 'mb-4'])>
            <label @class(['form-label', 'fw-bold', 'small'])>Ngày kết thúc</label>
            <input type="date" name="end_date" @class(['form-control', 'shadow-sm']) value="{{ old('end_date', $leave->end_date) }}">
            @error('end_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div @class(['mb-4'])>
        <label @class(['form-label', 'fw-bold', 'small'])>Lý do xin nghỉ phép</label>
        @error('reason')
        <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
        @enderror
        <textarea name="reason" @class(['form-control', 'shadow-sm']) rows="4">{{ old('reason', $leave->reason) }}</textarea>
    </div>
    <div @class(['d-flex', 'flex-column', 'flex-sm-row', 'gap-3'])>
        <button @class(['btn', 'btn-save', 'flex-grow-1']) title="Lưu thay đổi">Lưu thay đổi</button>
    </div>
</form>
@endsection