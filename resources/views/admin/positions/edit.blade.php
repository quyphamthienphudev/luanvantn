@extends('layouts.app')

@section('content')
<a href="/admin/positions" class="btn btn-secondary">
    ← Quay lại
</a>
<h1 class="text-2xl font-bold mb-6">
Cập nhật thông tin chức vụ
</h1>

<form action="/admin/positions/update/{{ $position->id }}" method="POST"
class="bg-white p-6 rounded shadow w-1/2">

@csrf
@error('name')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
@error('base_salary')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

<div class="mb-4">
<label>Tên chức vụ</label>
<input type="text" name="name"
value="{{ $position->name }}"
class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label>Lương cơ bản</label>
<input type="text" name="base_salary"
value="{{ $position->base_salary }}"
class="w-full border p-2 rounded">
</div>

<button
class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
Cập nhật
</button>

</form>

@endsection
