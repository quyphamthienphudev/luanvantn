@extends('layouts.app')

@section('title','Tra cứu thông tin chi tiết nhân viên')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Tra cứu thông tin chi tiết nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <div class="container mt-4">
        <h1 class="text-2xl font-bold mb-6">
            Chọn nhân viên để tra cứu
        </h1>
        <form method="GET" action="/hcns/employees/detail" class="bg-white p-6 rounded shadow w-1/2">

            <div class="mb-4">
            <label>Nhân viên</label>
            <select name="employee_full_name" class="w-full border p-2 rounded">
                @foreach($employees as $e)
                <option value="{{ $e->full_name }}">{{ $e->full_name }} - {{ $e->employee_code }}</option>
                @endforeach
            </select>
            </div>

            <!-- Button -->
            <button type="submit" name="detail"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Tra cứu">
                Tra cứu
            </button>

        </form>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách chấm công chi tiết
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Ngày làm việc</th>
                    <th class="p-3">Giờ vào</th>
                    <th class="p-3">Giờ ra</th>
                    <th class="p-3">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $a)
                <tr class="border-b">
                    <td class="p-3">{{ $a->name }}</td>
                    <td class="p-3">{{ $a->work_date ? date('d/m/Y', strtotime($a->work_date)) : '' }}</td>
                    <td class="p-3">{{ $a->check_in }}</td>
                    <td class="p-3">{{ $a->check_out }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs {{ $a->status == 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            @if($a->status == 'present')
                            Đúng giờ
                            @endif
                            @if($a->status == 'late')
                            Đi trễ
                            @endif
                            @if($a->status == 'absent')
                            Vắng mặt
                            @endif
                        </span>
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách khen thưởng
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Nội dung khen thưởng</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rewards as $r)
                <tr class="border-b">
                    <td class="p-3">{{ $r->full_name }}</td>
                    <td class="p-3">{{ $r->title }}</td>
                    <td class="p-3">{{ $r->amount }}</td>
                    <td class="p-3">{{ $r->decision_date ? date('d/m/Y', strtotime($r->decision_date)) : '' }}</td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách kỷ luật
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Nội dung kỷ luật</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                </tr>
            </thead>
            <tbody>
                @forelse($disciplines as $d)
                <tr class="border-b">
                    <td class="p-3">{{ $d->full_name }}</td>
                    <td class="p-3">{{ $d->title }}</td>
                    <td class="p-3">{{ $d->amount }}</td>
                    <td class="p-3">{{ $d->decision_date ? date('d/m/Y', strtotime($d->decision_date)) : '' }}</td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>

@endsection