@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Danh sách sinh viên tham gia project
</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Phạm Thiên Phú Quý</h3>
        <p class="text-lg font-semibold">
            % đóng góp: 40%
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Mai Hữu Trí</h3>
        <p class="text-lg font-semibold">
            % đóng góp: 15%
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Nguyễn Phạm Hoài Nam</h3>
        <p class="text-lg font-semibold">
            % đóng góp: 15%
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Trương Gia Khánh</h3>
        <p class="text-lg font-semibold">
            % đóng góp: 15%
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Nguyễn Duy Lê</h3>
        <p class="text-lg font-semibold">
            % đóng góp: 15%
        </p>
    </div>

</div>

@endsection
