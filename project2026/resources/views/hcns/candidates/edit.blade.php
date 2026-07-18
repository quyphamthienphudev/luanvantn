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
    <a href="/hcns/candidates" title="← Quay lại">← Quay lại</a>
    <form method="POST" action="/hcns/candidates/update/{{ $candidates->id }}" class="bg-white p-6 w-1/2">
        @csrf
        <div class="mb-4">
            <label>Mã hồ sơ</label>
            <input type="text" name="" value="{{ $candidates->candidate_id }}"
                class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Họ tên ứng viên</label>
            <input type="text" name="full_name" value="{{ $candidates->full_name }}" class="w-full border p-2 rounded"
                placeholder="Họ tên ứng viên">
            @error('full_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Tên</label>
            <input type="text" name="first_name" value="{{ $candidates->first_name }}" class="w-full border p-2 rounded"
                placeholder="Tên">
            @error('first_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Họ</label>
            <input type="text" name="last_name" value="{{ $candidates->last_name }}" class="w-full border p-2 rounded"
                placeholder="Họ">
            @error('last_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Giới tính</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="male" {{ $candidates->gender == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ $candidates->gender == 'female' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" value="{{ $candidates->date_of_birth }}"
                class="w-full border p-2 rounded">
            @error('date_of_birth')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Số điện thoại</label>
            <input type="text" name="phone" value="{{ $candidates->phone }}" class="w-full border p-2 rounded"
                placeholder="Số điện thoại">
            @error('phone')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Học vấn</label>
            <input type="text" name="education" value="{{ $candidates->education }}" class="w-full border p-2 rounded"
                placeholder="Học vấn">
            @error('education')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" value="{{ $candidates->email }}" class="w-full border p-2 rounded"
                placeholder="Email">
            @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="{{ $candidates->address }}" class="w-full border p-2 rounded"
                placeholder="Địa chỉ">
            @error('address')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input type="text" name="street" value="{{ $candidates->street }}" class="w-full border p-2 rounded"
                placeholder="Tên đường">
            @error('street')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input type="text" name="ward" value="{{ $candidates->ward }}" class="w-full border p-2 rounded"
                placeholder="Phường">
            @error('ward')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" value="{{ $candidates->province }}" class="w-full border p-2 rounded"
                placeholder="Tỉnh / Thành phố">
            @error('province')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật">Cập nhật</button>
    </form>
</body>

</html>

@endsection