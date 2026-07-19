@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật quyền truy cập</title>
</head>

<body>
    <a href="/httt/roles" class="btn btn-secondary" title="← Quay lại">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật quyền truy cập
    </h1>
    <form action="/httt/roles/update/{{ $roles->id }}" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        <div class="mb-4">
            <label>Tên quyền truy cập</label>
            <input type="text" value="{{ $roles->name }}" class="w-full border p-2 rounded bg-gray-100"
                readonly>
        </div>
        <div class="mb-4">
            <label>Mô tả</label>
            <input type="text" name="description" value="{{ $roles->description }}" class="w-full border p-2 rounded"
                placeholder="Mô tả">
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật">
            Cập nhật
        </button>
    </form>
</body>

</html>

@endsection