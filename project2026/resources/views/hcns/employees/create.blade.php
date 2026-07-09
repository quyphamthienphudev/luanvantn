@extends('layouts.app')

@section('title','Thêm nhân viên')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <form method="POST" action="/hcns/employees/store" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        <div class="mb-4">
            <label>Phòng ban</label>
            <select name="department_id" class="w-full border p-2 rounded">
                @foreach($departments as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input type="text" name="employee_code" class="w-full border p-2 rounded" placeholder="Mã nhân viên" maxlength="50" value="{{ old('employee_code') }}">
            @error('employee_code')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Họ tên nhân viên</label>
            <input type="text" name="full_name" class="w-full border p-2 rounded" placeholder="Họ tên nhân viên" value="{{ old('full_name') }}">
            @error('full_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" class="w-full border p-2 rounded" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Công việc</label>
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
            <input type="date" name="date_of_birth" class="w-full border p-2 rounded" value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="w-full border p-2 rounded" placeholder="Số điện thoại" value="{{ old('phone') }}">
            @error('phone')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="w-full border p-2 rounded" placeholder="Địa chỉ" value="{{ old('address') }}">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input type="text" name="street" class="w-full border p-2 rounded" placeholder="Tên đường" value="{{ old('street') }}">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input type="text" name="ward" class="w-full border p-2 rounded" placeholder="Phường" value="{{ old('ward') }}">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" class="w-full border p-2 rounded" placeholder="Tỉnh / Thành phố" value="{{ old('province') }}">
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">Lưu</button>
    </form>
</body>

</html>

@endsection