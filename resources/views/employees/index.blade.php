@extends('layouts.app')

@section('title','Quản lý nhân viên')

@section('content')

@if(auth()->user()->role->name=='admin')
<a href="/admin/employees/create" class="bg-blue-600 text-white px-4 py-2 rounded">
Thêm nhân viên
</a>
@endif

@if(auth()->user()->role->name=='user')
<a href="/employees/create" class="bg-blue-600 text-white px-4 py-2 rounded">
Thêm nhân viên
</a>
@endif

<form method="GET" class="mt-4">
Tìm kiếm: <input type="text" name="search" value="{{ $search }}" class="border p-2">
<button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
</form>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mt-4">
{{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Mã nhân viên</th>
<th class="p-3">Tên nhân viên</th>
<th class="p-3">Phòng ban</th>
<th class="p-3">Hành động</th>
</tr>
</thead>

<tbody>
@foreach($employees as $e)
<tr class="border-b">
<td class="p-3">{{ $e->employee_code }}</td>
<td class="p-3">{{ $e->full_name }}</td>
<td class="p-3">{{ $e->department->name }}</td>

<td class="p-3 space-x-2">
@if(auth()->user()->role->name=='admin')
<a href="/admin/employees/show/{{ $e->id }}" class="bg-blue-500 text-white px-3 py-1 rounded">Xem</a>
@endif

@if(auth()->user()->role->name=='user')
<a href="/employees/show/{{ $e->id }}" class="bg-blue-500 text-white px-3 py-1 rounded">Xem</a>
@endif

@if(auth()->user()->role->name=='admin')
<a href="/admin/employees/edit/{{ $e->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
@endif

@if(auth()->user()->role->name=='user')
<a href="/employees/edit/{{ $e->id }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
@endif

@if(auth()->user()->role->name=='admin')
<a href="/admin/employees/delete/{{ $e->id }}" class="bg-red-600 text-white px-3 py-1 rounded"
onclick="return confirm('Bạn có muốn xoá nhân viên này ?')">Xóa</a>
@endif
</td>

</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
