@extends('layouts.app')
@section('title','Cập nhật thông tin nhân viên')
@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/employees/update/{{ $employee->id }}" method="post" @class(['bg-white', 'p-6', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Phòng ban</label>
            <select name="department_id" @class(['w-full', 'border', 'p-2', 'rounded'])>
                @foreach($departments as $d)
                <option value="{{ $d->id }}" {{ $employee->department_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div @class(['mb-4'])>
            <label>Mã nhân viên</label>
            <input type="text" value="{{ $employee->employee_code }}" @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Họ tên nhân viên</label>
            <input type="text" name="full_name" value="{{ old('full_name', $employee->full_name) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Họ tên nhân viên">
            @error('full_name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Email</label>
            <input type="text" name="email" value="{{ old('email', $employee->email) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Email">
            @error('email')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Công việc</label>
            <select name="position_id" @class(['w-full', 'border', 'p-2', 'rounded'])>
                @foreach($positions as $p)
                <option value="{{ $p->id }}" {{ $employee->position_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div @class(['mb-4'])>
            <label>Giới tính</label>
            <select name="gender" @class(['w-full', 'border', 'p-2', 'rounded'])>
                <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>
        <div @class(['mb-4'])>
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}" @class(['w-full', 'border', 'p-2', 'rounded'])>
            @error('date_of_birth')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>CCCD</label>
            <input type="text" name="identify" value="{{ old('identify', $employee->identify) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="CCCD">
            @error('identify')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Quốc tịch</label>
            <input type="text" name="national" value="{{ old('national', $employee->national) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Quốc tịch">
            @error('national')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Nơi sinh</label>
            <input type="text" name="birthplace" value="{{ old('birthplace', $employee->birthplace) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Nơi sinh">
            @error('birthplace')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Ngày cấp</label>
            <input type="date" name="issue_date" value="{{ old('issue_date', $employee->issue_date) }}" @class(['w-full', 'border', 'p-2', 'rounded'])>
            @error('issue_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Dân tộc</label>
            <input type="text" name="ethnic_group" value="{{ old('ethnic_group', $employee->ethnic_group) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Dân tộc">
            @error('ethnic_group')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Số điện thoại">
            @error('phone')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Địa chỉ</label>
            <input type="text" name="address" value="{{ old('address', $employee->address) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Địa chỉ">
        </div>
        <div @class(['mb-4'])>
            <label>Tên đường</label>
            <input type="text" name="street" value="{{ old('street', $employee->street) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tên đường">
        </div>
        <div @class(['mb-4'])>
            <label>Phường</label>
            <input type="text" name="ward" value="{{ old('ward', $employee->ward) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Phường">
        </div>
        <div @class(['mb-4'])>
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" value="{{ old('province', $employee->province) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tỉnh / Thành phố">
        </div>
        <div @class(['mb-4'])>
            <label>Ngày vào làm</label>
            <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" @class(['w-full', 'border', 'p-2', 'rounded'])>
            @error('hire_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Trạng thái</label>
            <select name="status" @class(['w-full', 'border', 'p-2', 'rounded'])>
                <option value="working" {{ $employee->status == 'working' ? 'selected' : '' }}>Đang làm</option>
                <option value="resigned" {{ $employee->status == 'resigned' ? 'selected' : '' }}>Đã nghỉ</option>
            </select>
        </div>
        <button @class(['bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-700']) title="Cập nhật">Cập nhật</button>
    </form>
</body>

</html>
@endsection
