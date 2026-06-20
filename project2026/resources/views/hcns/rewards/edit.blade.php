@extends('layouts.app')

@section('title','Cập nhật thông tin khen thưởng')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin khen thưởng</title>
</head>
<body>
    <a href="/hcns/rewards">← Quay lại</a>
    <form method="POST" action="/hcns/rewards/update/{{ $rewards->id }}" class="bg-white p-6 w-1/2">
        @csrf
        @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('amount')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('decision_date')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label>Nội dung khen thưởng</label>
            <input type="text" name="title" value="{{ $rewards->title }}" class="w-full border p-2 rounded" placeholder="Nội dung khen thưởng">
        </div>
        <div class="mb-4">
            <label>Số tiền</label>
            <input type="text" name="amount" value="{{ $rewards->amount }}" class="w-full border p-2 rounded" placeholder="Số tiền">
        </div>
        <div class="mb-4">
            <label>Ngày ra quyết định</label>
            <input type="date" name="decision_date" value="{{ $rewards->decision_date }}" class="w-full border p-2 rounded">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
    </form>
</body>
</html>

@endsection