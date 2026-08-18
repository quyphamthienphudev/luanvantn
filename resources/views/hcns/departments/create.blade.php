@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm phòng ban</title>
</head>

<body>
    <a href="/hcns/departments" @class(['btn', 'btn-secondary']) title="← Quay lại">
        ← Quay lại
    </a>
    <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>
        Thêm phòng ban
    </h1>
    <form action="/hcns/departments/store" method="post" @class(['bg-white', 'p-6', 'rounded', 'shadow', 'w-1/2'])>
        @csrf
        <div @class(['mb-4'])>
            <label>Tên phòng ban</label>
            <input type="text" name="name" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Tên phòng ban" maxlength="100" value="{{ old('name') }}">
            @error('name')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <div @class(['mb-4'])>
            <label>Mô tả thông tin</label>
            <input type="text" name="description" @class(['w-full', 'border', 'p-2', 'rounded']) placeholder="Mô tả thông tin" value="{{ old('description') }}">
            @error('description')
            <p @class(['text-red-500', 'text-sm'])>{{ $message }}</p>
            @enderror
        </div>
        <button @class(['bg-green-600', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-green-700']) title="Lưu">Lưu</button>
    </form>
</body>

</html>

@endsection