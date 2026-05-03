@extends('layouts.app')

@section('title', 'Quản lý chức vụ')

@section('content')

<a href="/admin/positions/create"
class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
Thêm chức vụ
</a>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mt-4">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-200 text-red-800 p-3 rounded mt-4">
{{ session('error') }}
</div>
@endif

<div class="bg-white shadow rounded mt-6">

<table class="w-full text-left">

<thead class="bg-gray-200">

<tr>
<th class="p-3">Tên chức vụ</th>
<th class="p-3">Lương cơ bản</th>
<th class="p-3">Hành động</th>
</tr>

</thead>

<tbody>

@foreach($positions as $position)

<tr class="border-b">

<td class="p-3">{{ $position->name }}</td>
<td class="p-3">{{ $position->base_salary }}</td>

<td class="p-3 space-x-2">

<a href="/admin/positions/edit/{{ $position->id }}"
class="bg-yellow-500 text-white px-3 py-1 rounded">
Sửa
</a>

<a href="/admin/positions/delete/{{ $position->id }}"
class="bg-red-600 text-white px-3 py-1 rounded"
onclick="return confirm('Bạn có muốn xoá chức vụ này ?')">
Xóa
</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection
