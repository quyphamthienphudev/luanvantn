@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm tài khoản</title>
</head>

<body>
    <a href="/httt/accounts" class="btn btn-secondary" title="← Quay lại">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6" title="Thêm tài khoản">
        Thêm tài khoản
    </h1>
    <form action="/httt/accounts/store" method="post" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        <div class="mb-4">
            <label>Họ tên</label>
            <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Họ tên" value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" class="w-full border p-2 rounded" placeholder="Email" maxlength="150" value="{{ old('email') }}">
            @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="w-full border p-2 rounded" placeholder="Mật khẩu" value="{{ old('password') }}">
            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Quyền</label>
            <select name="role" class="w-full border p-2 rounded">
                @foreach($roles as $r)
                <option value="{{ $r->id }}">{{ $r->description }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">
            Lưu
        </button>
    </form>
</body>

</html>

@endsection