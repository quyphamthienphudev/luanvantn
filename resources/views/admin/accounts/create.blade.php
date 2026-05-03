@extends('layouts.app')

@section('content')
<a href="/admin/accounts" class="btn btn-secondary">
    ← Quay lại
</a>
<h1 class="text-2xl font-bold mb-6">
Thêm tài khoản
</h1>

<form action="/admin/accounts/store" method="POST" class="bg-white p-6 rounded shadow w-1/2">

@csrf
@error('name')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('email')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('password')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
<div class="mb-4">
<label>Tên</label>
<input type="text" name="name"
class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Email</label>
<input type="text" name="email"
class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Mật khẩu</label>
<input type="password" name="password"
class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Quyền</label>
<select name="role" class="w-full border p-2 rounded">

<option value="2">User</option>
<option value="1">Admin</option>

</select>
</div>

<button
class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
Lưu
</button>

</form>

@endsection