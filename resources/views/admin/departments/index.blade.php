@extends('layouts.app')

@section('title','Danh sách phòng ban')

@section('content')

<a href="/admin/departments/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Thêm phòng ban</a>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mt-4">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-200 text-black-800 p-3 rounded mt-4">
{{ session('error') }}
</div>
@endif

<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Tên phòng ban</th>
<th class="p-3">Mô tả thông tin</th>
<th class="p-3">Hành động</th>
</tr>
</thead>

<tbody>
@foreach($departments as $d)
<tr class="border-b">
<td class="p-3">{{ $d->name }}</td>
<td class="p-3">{{ $d->description }}</td>
<td class="p-3 space-x-2">
<a href="/admin/departments/edit/{{ $d->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
<a href="/admin/departments/delete/{{ $d->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
onclick="return confirm('Bạn có muốn xoá phòng ban này ?')">Xóa</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

@endsection