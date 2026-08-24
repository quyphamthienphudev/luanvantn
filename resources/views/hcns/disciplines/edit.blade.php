@extends('layouts.app')
@section('title','Cập nhật thông tin kỷ luật')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin kỷ luật</title>
</head>

<body>
    <a href="/hcns/disciplines" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/disciplines/update/{{ $disciplines->id }}" method="post" @class(['bg-white', 'p-6', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Nhân viên</label>
            <input type="text" value="{{ $disciplines->employee->full_name }}" @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Mã nhân viên</label>
            <input type="text" value="{{ $disciplines->employee->employee_code }}" @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Nội dung kỷ luật</label>
            <input type="text" name="title" value="{{ old('title', $disciplines->title) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Nội dung kỷ luật">
            @error('title')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Số tiền</label>
            <input type="text" name="amount" value="{{ old('amount', $disciplines->amount) }}" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Số tiền">
            @error('amount')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Ngày ra quyết định</label>
            <input type="date" name="decision_date" value="{{ old('decision_date', $disciplines->decision_date) }}" @class(['w-full', 'border', 'p-2', 'rounded'])>
            @error('decision_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <button @class(['bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-700']) title="Cập nhật">Cập nhật</button>
    </form>
</body>

</html>
@endsection