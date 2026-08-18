@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin công việc</title>
</head>

<body>
    <a href="/hcns/positions" @class(['btn', 'btn-secondary']) title="← Quay lại">
        ← Quay lại
    </a>
    <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>
        Cập nhật thông tin công việc
    </h1>
    <form action="/hcns/positions/update/{{ $position->id }}" method="post" @class(['bg-white', 'p-6', 'rounded', 'shadow', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Tên công việc</label>
            <input type="text" name="name" value="{{ old('name', $position->name) }}" @class(['w-full', 'border', 'p-2', 'rounded'])
                placeholder="Tên công việc" maxlength="100">
            @error('name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Lương cơ bản</label>
            <input type="text" name="base_salary" value="{{ old('base_salary', $position->base_salary) }}" @class(['w-full', 'border', 'p-2', 'rounded'])
                placeholder="Lương cơ bản">
            @error('base_salary')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Lương cao nhất</label>
            <input type="text" name="max_salary" value="{{ old('max_salary', $position->max_salary) }}" @class(['w-full', 'border', 'p-2', 'rounded'])
                placeholder="Lương cao nhất">
            @error('max_salary')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <button @class(['bg-blue-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-700']) title="Cập nhật">
            Cập nhật
        </button>
    </form>
</body>
</html>

@endsection