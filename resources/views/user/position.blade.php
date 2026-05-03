@extends('layouts.app')

@section('title','Danh sách chức vụ')

@section('content')

<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Tên chức vụ</th>
<th class="p-3">Lương cơ bản</th>
</tr>
</thead>

<tbody>
@foreach($positions as $p)
<tr class="border-b">
<td class="p-3">{{ $p->name }}</td>
<td class="p-3">{{ $p->base_salary }} VNĐ</td>
</tr>
@endforeach
</tbody>

</table>
</div>

@endsection
