@extends('layouts.app')

@section('title', 'Sửa thông tin chấm công')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Sửa thông tin chấm công</title>
</head>
<body>
    <a href="/hcns/attendances" class="btn btn-secondary">
    ← Quay lại
</a>
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-yellow-600">Sửa chấm công nhân viên {{ $attendance->employee?->full_name }}</h2>

    <form action="/hcns/attendances/update/{{ $attendance->id }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Ngày làm việc</label>
                <input type="date" name="work_date" value="{{ $attendance->work_date }}" class="w-full border rounded p-2 outline-none bg-gray-100" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Trạng thái</label>
                <select name="status" class="w-full border rounded p-2 outline-none">
                    <option value="present">Đúng giờ</option>
                    <option value="late">Đi muộn</option>
                    <option value="absent">Vắng mặt</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Giờ vào</label>
                <input type="time" name="check_in" value="{{ $attendance->check_in }}" class="w-full border rounded p-2 outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Giờ ra</label>
                <input type="time" name="check_out" value="{{ $attendance->check_out }}" class="w-full border rounded p-2 outline-none">
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 font-bold">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>

@endsection
