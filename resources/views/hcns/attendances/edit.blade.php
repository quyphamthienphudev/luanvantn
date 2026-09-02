@extends('layouts.app')
@section('title', 'Sửa thông tin chấm công')
@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Sửa thông tin chấm công</title>
</head>

<body>
    <a href="/hcns/attendances" @class(['btn', 'btn-secondary']) title="← Quay lại">← Quay lại</a>
    <div @class(['max-w-4xl', 'mx-auto', 'mt-10', 'bg-white', 'p-8', 'rounded-lg', 'shadow'])>
        <h2 @class(['text-2xl', 'font-bold', 'mb-6', 'text-gray-800', 'text-black-600'])>Sửa thông tin chấm công</h2>
        <form action="/hcns/attendances/update/{{ $attendance->id }}" method="post">
            @csrf
            <div @class(['grid', 'grid-cols-2', 'gap-6'])>
                <div @class(['mb-4'])>
                    <label @class(['block', 'text-gray-700', 'font-bold', 'mb-2'])>Mã nhân viên</label>
                    <input type="text" value="{{ $attendance->employee_code }}" @class(['w-full', 'border', 'rounded', 'p-2', 'outline-none', 'bg-gray-100']) readonly>
                </div>
                <div @class(['mb-4'])>
                    <label @class(['block', 'text-gray-700', 'font-bold', 'mb-2'])>Tên nhân viên</label>
                    <input type="text" value="{{ $attendance->name }}" @class(['w-full', 'border', 'rounded', 'p-2', 'outline-none', 'bg-gray-100']) readonly>
                </div>
                <div @class(['mb-4'])>
                    <label @class(['block', 'text-gray-700', 'font-bold', 'mb-2'])>Ngày làm việc</label>
                    <input type="date" value="{{ $attendance->work_date }}" @class(['w-full', 'border', 'rounded', 'p-2', 'outline-none', 'bg-gray-100']) readonly>
                </div>
                <div @class(['mb-4'])>
                    <label @class(['block', 'text-gray-700', 'font-bold', 'mb-2'])>Giờ vào</label>
                    <input type="time" name="check_in" value="{{ old('check_in', $attendance->check_in) }}" @class(['w-full', 'border', 'rounded', 'p-2', 'outline-none'])>
                </div>
                <div @class(['mb-4'])>
                    <label @class(['block', 'text-gray-700', 'font-bold', 'mb-2'])>Giờ ra</label>
                    <input type="time" name="check_out" value="{{ old('check_out', $attendance->check_out) }}" @class(['w-full', 'border', 'rounded', 'p-2', 'outline-none'])>
                </div>
            </div>
            <div @class(['flex', 'justify-end', 'mt-6'])>
                <button @class(['bg-blue-500', 'text-white', 'px-6', 'py-2', 'rounded', 'hover:bg-blue-600', 'font-bold']) title="Cập nhật">Cập nhật</button>
            </div>
        </form>
    </div>
</body>

</html>
@endsection