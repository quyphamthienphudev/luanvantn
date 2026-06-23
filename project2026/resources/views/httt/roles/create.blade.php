@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm quyền truy cập</title>
</head>

<body>
    <a href="/httt/roles" class="btn btn-secondary">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Thêm quyền truy cập
    </h1>
    <form action="/httt/roles/store" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        @error('id')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('description')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label>ID</label>
            <input type="text" name="id" class="w-full border p-2 rounded" placeholder="ID">
        </div>
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Name">
        </div>
        <div class="mb-4">
            <label>Mô tả</label>
            <input type="text" name="description" class="w-full border p-2 rounded" placeholder="Mô tả">
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Lưu
        </button>
    </form>
</body>

</html>

@endsection