@extends('layouts.app')

@section('title','Danh sách phòng ban')

@section('content')

<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Tên phòng ban</th>
<th class="p-3">Mô tả thông tin</th>
</tr>
</thead>

<tbody>
@foreach($departments as $d)
<tr class="border-b">
<td class="p-3">{{ $d->name }}</td>
<td class="p-3">{{ $d->description }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
