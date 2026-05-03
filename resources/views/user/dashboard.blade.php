@extends('layouts.app')

@section('title', 'Thống kê')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Tổng nhân viên
</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Tổng nhân viên</h3>
        <p class="text-lg font-semibold">
            {{ $working }}
        </p>
    </div>

</div>

@endsection
