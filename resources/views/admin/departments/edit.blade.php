@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin phòng ban</title>
</head>
<body>
    <a href="/admin/departments" class="btn btn-secondary">
    ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
    Cập nhật thông tin phòng ban
    </h1>
    <form method="POST" action="/admin/departments/update/{{ $department->id }}" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('description')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label>Tên phòng ban</label>
            <input name="name" value="{{ $department->name }}" class="border p-2 w-full mb-2">
        </div>
        <div class="mb-4">
            <label>Mô tả thông tin</label>
            <input name="description" value="{{ $department->description }}" class="border p-2 w-full mb-2">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
    </form>
</body>
</html>

@endsection