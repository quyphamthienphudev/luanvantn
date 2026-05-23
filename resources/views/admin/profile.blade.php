@extends('layouts.app')

@section('title', 'Cập nhật thông tin cá nhân')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin cá nhân</title>
</head>
<body>
    <div class="bg-white p-6 rounded-xl shadow w-1/2">
    @if(session('success'))
        <div class="text-green-600 mb-4">
            {{ session('success') }}
        </div>
    @endif
    @error('name')
    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
    @error('email')
    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
    <form method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Họ tên</label>
            <input type="text" name="name"
                   value="{{ auth()->user()->name }}"   
                   class="w-full px-4 py-2 border rounded">         
        </div>
        <div class="mb-4">
            <label class="block mb-2">Email</label>
            <input type="text" name="email"
                   value="{{ auth()->user()->email }}"
                   class="w-full px-4 py-2 border rounded">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Cập nhật
        </button>
    </form>
</div>
</body>
</html>

@endsection