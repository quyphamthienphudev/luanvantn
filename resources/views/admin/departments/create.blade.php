@extends('layouts.app')

@section('content')
<a href="/admin/departments" class="btn btn-secondary">
    ← Quay lại
</a>
<h1 class="text-2xl font-bold mb-6">
Thêm phòng ban
</h1>


<form method="POST" action="/admin/departments/store" class="bg-white p-6 rounded shadow w-1/2">
@csrf
@error('name')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('description')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
<div class="mb-4">
<label>Tên phòng ban</label>
<input name="name" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Mô tả thông tin</label>
<input name="description" class="w-full border p-2 rounded">
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>

</form>

@endsection