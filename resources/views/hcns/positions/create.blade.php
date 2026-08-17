@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm công việc</title>
</head>

<body>
    <a href="/hcns/positions" class="btn btn-secondary" title="← Quay lại">
        ← Quay lại
    </a>
    @if(session('error'))
    <div class="bg-red-200 text-red-800 p-3 rounded shadow w-1/2">
        {{ session('error') }}
    </div>
    @endif
    <br>
    <h1 class="text-2xl font-bold mb-6">
        Thêm công việc
    </h1>
    <form action="/hcns/positions/store" method="post" class="bg-white p-6 rounded shadow w-1/2">
        @csrf
        <div class="mb-4">
            <label>Tên công việc</label>
            <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Tên công việc" maxlength="100" value="{{ old('name') }}">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Lương cơ bản</label>
            <input type="text" name="base_salary" class="w-full border p-2 rounded" placeholder="Lương cơ bản" value="{{ old('base_salary') }}">
            @error('base_salary')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Lương cao nhất</label>
            <input type="text" name="max_salary" class="w-full border p-2 rounded" placeholder="Lương cao nhất" value="{{ old('max_salary') }}">
            @error('max_salary')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">
            Lưu
        </button>
    </form>
</body>

</html>

@endsection