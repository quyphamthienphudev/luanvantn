@extends('layouts.app')

@section('title','Gia hạn hợp đồng lao động')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Gia hạn hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/contracts/extend/{{ $contract->id }}" method="post" @class(['bg-white', 'p-6', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Mã hợp đồng</label>
            <input type="text" value="{{ $contract->contract_code }}"
                @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Nhân viên</label>
            <input type="text" value="{{ $contract->employee->full_name }}"
                @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Ngày bắt đầu</label>
            <input type="date" value="{{ $contract->end_date }}" @class(['w-full', 'border', 'p-2', 'rounded', 'bg-gray-100']) readonly>
        </div>
        <div @class(['mb-4'])>
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" @class(['w-full', 'border', 'p-2', 'rounded'])>
            @error('end_date')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Ghi chú hợp đồng</label>
            <textarea name="description" @class(['w-full', 'border', 'p-2', 'rounded']) rows="10" cols="40">{{ old('description', $contract->description) }}</textarea>
        </div>
        <button @class(['bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-700']) title="Gia hạn">Gia hạn</button>
    </form>
</body>

</html>

@endsection