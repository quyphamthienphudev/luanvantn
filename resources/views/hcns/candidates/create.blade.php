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
    <a href="/hcns/candidates" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/candidates/store" method="post" @class(['bg-white', 'p-6', 'rounded', 'shadow', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Mã hồ sơ</label>
            <input type="text" name="candidate_id" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Mã hồ sơ" maxlength="20" value="{{ old('candidate_id') }}">
            @error('candidate_id')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Họ tên nhân viên</label>
            <input type="text" name="full_name" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Họ tên nhân viên" value="{{ old('full_name') }}">
            @error('full_name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Tên</label>
            <input type="text" name="first_name" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tên" value="{{ old('first_name') }}">
            @error('first_name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Họ</label>
            <input type="text" name="last_name" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Họ" value="{{ old('last_name') }}">
            @error('last_name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Giới tính</label>
            <select name="gender" @class(['w-full', 'border', 'p-2', 'rounded'])>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
        </div>
        <div @class(['mb-4'])>
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" @class(['w-full', 'border', 'p-2', 'rounded']) value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Số điện thoại</label>
            <input type="text" name="phone" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Số điện thoại" value="{{ old('phone') }}">
            @error('phone')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Học vấn</label>
            <input type="text" name="education" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Học vấn" value="{{ old('education') }}">
            @error('education')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Email</label>
            <input type="text" name="email" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Địa chỉ</label>
            <input type="text" name="address" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Địa chỉ" value="{{ old('address') }}">
            @error('address')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Tên đường</label>
            <input type="text" name="street" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tên đường" value="{{ old('street') }}">
            @error('street')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Phường</label>
            <input type="text" name="ward" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Phường" value="{{ old('ward') }}">
            @error('ward')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tỉnh / Thành phố" value="{{ old('province') }}">
            @error('province')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <button @class(['bg-green-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-green-700']) title="Lưu">Lưu</button>
    </form>
</body>

</html>
@endsection