@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin tài khoản</title>
</head>
<body>
    <a href="/admin/accounts" class="btn btn-secondary">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật thông tin tài khoản
    </h1>
    <form action="/admin/accounts/update/{{ $user->id }}" method="POST"
    class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label>Họ tên</label>
            <input type="text" name="name"
            value="{{ $user->name }}"
            class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email"
            value="{{ $user->email }}"
            class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Quyền</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="2"
                @if($user->role_id=='2') selected @endif
                >User</option>
                <option value="1"
                @if($user->role_id=='1') selected @endif
                >Admin</option>
            </select>
        </div>
        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cập nhật
        </button>
    </form>
    @if($user->role_id == '2')
    <div class="bg-white p-6 rounded shadow w-1/2">
    <h3 class="text-2xl font-bold mb-6">
        Reset mật khẩu
    </h3>
    @error('new_password')
    <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
    @if(session('success'))
    <div class="text-green-600 mb-4">
    {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('admin.accounts.resetPassword', $user->id) }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Mật khẩu mới</label>
            <input type="password"
                name="new_password"
                class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Reset mật khẩu
        </button>
    </form>
    </div>
    @endif
</body>
</html>

@endsection