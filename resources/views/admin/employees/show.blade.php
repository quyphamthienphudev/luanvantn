@extends('layouts.app')

@section('title','Chi tiết nhân viên')

@section('content')

<a href="/admin/employees">← Quay lại</a>

<div class="bg-white p-6">
<p>Mã: {{ $employee->employee_code }}</p>
<p>Tên: {{ $employee->full_name }}</p>
<p>Phòng ban: {{ $employee->department->name }}</p>
<p>Email: {{ $employee->email }}</p>
<p>Chức vụ: {{ $employee->position->name }}</p>
<p>Giới tính:
    @if($employee->gender == 'male')
        Nam
    @else
        Nữ
    @endif
</p>
<p>Ngày sinh: {{ $employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : '' }}</p>
<p>SĐT: {{ $employee->phone }}</p>
<p>Địa chỉ: {{ $employee->address }}</p>
<p>Ngày vào làm: 
    {{ $employee->hire_date ? date('d/m/Y', strtotime($employee->hire_date)) : '' }}
</p>
<p>Trạng thái: 
    @if($employee->status == 'working')
        Đang làm việc
    @else
        Đã nghỉ việc
    @endif
</p>
</div>

@endsection