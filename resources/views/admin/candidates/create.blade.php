@extends('layouts.app')

@section('title','Thêm hồ sơ ứng viên')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm hồ sơ ứng viên</title>
</head>
<body>
    <a href="/admin/candidates">← Quay lại</a>
    <form method="POST" action="/admin/candidates/store" class="bg-white p-6 rounded shadow w-1/2">
    @csrf
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
            <label>Mã hồ sơ</label>
            <input type="text" name="candidate_id" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Họ tên nhân viên</label>
            <input type="text" name="full_name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên</label>
            <input type="text" name="first_name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Họ</label>
            <input type="text" name="last_name" class="w-full border p-2 rounded">
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
            <input type="text" name="phone" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Học vấn</label>
            <input type="text" name="education" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input type="text" name="street" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input type="text" name="ward" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" class="w-full border p-2 rounded">
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>
    </form>
</body>
</html>

@endsection