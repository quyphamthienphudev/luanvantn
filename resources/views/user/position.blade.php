@extends('layouts.app')

@section('title','Danh sách chức vụ')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Xem danh sách chức vụ</title>
</head>
<body>
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
</body>
</html>

@endsection