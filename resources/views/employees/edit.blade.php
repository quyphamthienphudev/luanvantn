@extends('layouts.app')

@section('title','Sửa nhân viên')

@section('content')

@if(auth()->user()->role->name=='admin')
<a href="/admin/employees">← Quay lại</a>
@endif

@if(auth()->user()->role->name=='user')
<a href="/employees">← Quay lại</a>
@endif

@if(auth()->user()->role->name=='admin')
<form method="POST" action="/admin/employees/update/{{ $employee->id }}" class="bg-white p-6 w-1/2">
@csrf
@error('employee_code')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('full_name')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('hire_date')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('email')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('date_of_birth')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('phone')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
<div class="mb-4">
<label>Mã nhân viên</label>
<input name="employee_code" value="{{ $employee->employee_code }}" class="w-full border p-2 rounded bg-gray-100" readonly>
</div>

<div class="mb-4">
<label>Họ tên nhân viên</label>
<input name="full_name" value="{{ $employee->full_name }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Phòng ban</label>
<select name="department_id" class="w-full border p-2 rounded">
@foreach($departments as $d)
<option value="{{ $d->id }}" {{ $employee->department_id==$d->id?'selected':'' }}>
{{ $d->name }}
</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Email</label>
<input name="email" value="{{ $employee->email }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Chức vụ</label>
<select name="position_id" class="w-full border p-2 rounded">
@foreach($positions as $p)
<option value="{{ $p->id }}" {{ $employee->position_id==$p->id?'selected':'' }}>
{{ $p->name }}
</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Giới tính</label>
<select name="gender" class="w-full border p-2 rounded">
<option value="male" {{ $employee->gender=='male'?'selected':'' }}>Nam</option>
<option value="female" {{ $employee->gender=='female'?'selected':'' }}>Nữ</option>
</select>
</div>

<div class="mb-4">
<label>Ngày sinh</label>
<input type="date" name="date_of_birth" value="{{ $employee->date_of_birth }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Số điện thoại</label>
<input name="phone" value="{{ $employee->phone }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Địa chỉ</label>
<input name="address" value="{{ $employee->address }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Ngày vào làm</label>
<input type="date" name="hire_date" value="{{ $employee->hire_date }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Trạng thái</label>
<select name="status" class="w-full border p-2 rounded">
<option value="working" {{ $employee->status=='working'?'selected':'' }}>Đang làm</option>
<option value="resigned" {{ $employee->status=='resigned'?'selected':'' }}>Đã nghỉ</option>
</select>
</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>

</form>
@endif

@if(auth()->user()->role->name=='user')
<form method="POST" action="/employees/update/{{ $employee->id }}" class="bg-white p-6 w-1/2">
@csrf
@error('employee_code')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('full_name')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('hire_date')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('email')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('date_of_birth')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('phone')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
<div class="mb-4">
<label>Mã nhân viên</label>
<input name="employee_code" value="{{ $employee->employee_code }}" class="w-full border p-2 rounded bg-gray-100" readonly>
</div>

<div class="mb-4">
<label>Họ tên nhân viên</label>
<input name="full_name" value="{{ $employee->full_name }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Phòng ban</label>
<select name="department_id" class="w-full border p-2 rounded">
@foreach($departments as $d)
<option value="{{ $d->id }}" {{ $employee->department_id==$d->id?'selected':'' }}>
{{ $d->name }}
</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Email</label>
<input name="email" value="{{ $employee->email }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Chức vụ</label>
<select name="position_id" class="w-full border p-2 rounded">
@foreach($positions as $p)
<option value="{{ $p->id }}" {{ $employee->position_id==$p->id?'selected':'' }}>
{{ $p->name }}
</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Giới tính</label>
<select name="gender" class="w-full border p-2 rounded">
<option value="male" {{ $employee->gender=='male'?'selected':'' }}>Nam</option>
<option value="female" {{ $employee->gender=='female'?'selected':'' }}>Nữ</option>
</select>
</div>

<div class="mb-4">
<label>Ngày sinh</label>
<input type="date" name="date_of_birth" value="{{ $employee->date_of_birth }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Số điện thoại</label>
<input name="phone" value="{{ $employee->phone }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Địa chỉ</label>
<input name="address" value="{{ $employee->address }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Ngày vào làm</label>
<input type="date" name="hire_date" value="{{ $employee->hire_date }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Trạng thái</label>
<select name="status" class="w-full border p-2 rounded">
<option value="working" {{ $employee->status=='working'?'selected':'' }}>Đang làm</option>
<option value="resigned" {{ $employee->status=='resigned'?'selected':'' }}>Đã nghỉ</option>
</select>
</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>

</form>
@endif

@endsection
