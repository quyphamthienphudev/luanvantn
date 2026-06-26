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
    <a href="/httt/accounts" class="btn btn-secondary">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật thông tin tài khoản
    </h1>
    <form action="/httt/accounts/update/{{ $user->id }}" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label>Họ tên</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2 rounded"
                placeholder="Họ tên">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" value="{{ $user->email }}" class="w-full border p-2 rounded"
                placeholder="Email">
        </div>
        <div class="mb-4">
            <label>Quyền</label>
            <select name="role" class="w-full border p-2 rounded">
                @foreach($roles as $r)
                <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>
                    {{ $r->description }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Trạng thái</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active" @if($user->status == 'active') selected @endif
                    >Đang hoạt động</option>
                <option value="suspend" @if($user->status == 'suspend') selected @endif
                    >Tạm dừng</option>
            </select>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Cập nhật
        </button>
    </form>
</body>

</html>

@endsection