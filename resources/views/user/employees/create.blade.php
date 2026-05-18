@extends('layouts.app')

@section('title','Thêm nhân viên')

@section('content')

<a href="/employees">← Quay lại</a>

<form method="POST" action="/employees/store" class="bg-white p-6 rounded shadow w-1/2">
@csrf
@error('employee_code')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('full_name')
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
<input name="employee_code" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Họ tên nhân viên</label>
<input name="full_name" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Phòng ban</label>
<select name="department_id" class="w-full border p-2 rounded">
@foreach($departments as $d)
<option value="{{ $d->id }}">{{ $d->name }}</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Email</label>
<input name="email" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Chức vụ</label>
<select name="position_id" class="w-full border p-2 rounded">
@foreach($positions as $p)
<option value="{{ $p->id }}">{{ $p->name }}</option>
@endforeach
</select>
</div>

<div class="mb-4">
<label>Giới tính</label>
<select name="gender" class="w-full border p-2 rounded">
<option value="male">Nam</option>
<option value="female">Nữ</option>
</select>
</div>

<div class="mb-4">
<label>Ngày sinh</label>
<input type="date" name="date_of_birth" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Số điện thoại</label>
<input name="phone" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Địa chỉ</label>
<input name="address" class="w-full border p-2 rounded">
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>

</form>

@endsection
