@extends('layouts.app')

@section('title','Cập nhật thông tin hồ sơ ứng viên')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin hồ sơ ứng viên</title>
</head>
<body>
    <a href="/admin/candidates">← Quay lại</a>
    <form method="POST" action="/admin/candidates/update/{{ $candidates->id }}" class="bg-white p-6 w-1/2">
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
            <label>Họ tên ứng viên</label>
            <input name="full_name" value="{{ $candidates->full_name }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input name="email" value="{{ $candidates->email }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Giới tính</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="male" {{ $candidates->gender=='male'?'selected':'' }}>Nam</option>
                <option value="female" {{ $candidates->gender=='female'?'selected':'' }}>Nữ</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" value="{{ $candidates->date_of_birth }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Số điện thoại</label>
            <input name="phone" value="{{ $candidates->phone }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input name="address" value="{{ $candidates->address }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input name="street" value="{{ $candidates->street }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input name="ward" value="{{ $candidates->ward }}" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input name="province" value="{{ $candidates->province }}" class="w-full border p-2 rounded">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
    </form>
</body>
</html>

@endsection