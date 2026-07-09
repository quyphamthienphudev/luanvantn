@extends('layouts.app')

@section('title','Chi tiết nhân viên')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <div class="bg-white p-6">
        <p>Mã nhân viên: {{ $employee->employee_code }}</p>
        <p>Họ tên nhân viên: {{ $employee->full_name }}</p>
        <p>Phòng ban: {{ $employee->department->name }}</p>
        <p>Email: {{ $employee->email }}</p>
        <p>Công việc: {{ $employee->position->name }}</p>
        <p>Giới tính:
            @if($employee->gender == 'male')
            Nam
            @else
            Nữ
            @endif
        </p>
        <p>Ngày sinh: {{ $employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : '' }}</p>
        <p>SĐT: {{ $employee->phone }}</p>
        <p>Địa chỉ: {{ $employee->address }} , {{ $employee->street }} , {{ $employee->ward }} , {{ $employee->province
            }}</p>
        <p>Ngày vào làm:
            {{ $employee->hire_date ? date('d/m/Y', strtotime($employee->hire_date)) : '' }}
        </p>
        <p>Trạng thái:
            @if($employee->status == 'working')
            Đang làm việc
            @else
            Đã nghỉ việc
            @endif
        </p>
        <hr class="my-4">
        <h3 class="font-bold text-lg">
            Chứng chỉ
        </h3>
        <form method="POST" action="/hcns/employees/{{ $employee->id }}/certificate/store"
            enctype="multipart/form-data">
            @csrf
            @error('certificate_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('issue_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('expiry_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('certificate_file')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <div class="mb-3">
                <label>Tên chứng chỉ</label>
                <input type="text" name="certificate_name" class="border p-2 w-full" value="{{ old('certificate_name') }}">
            </div>
            <div class="mb-3">
                <label>Ngày cấp</label>
                <input type="date" name="issue_date" class="border p-2 w-full" value="{{ old('issue_date') }}">
            </div>
            <div class="mb-3">
                <label>Ngày hết hạn</label>
                <input type="date" name="expiry_date" class="border p-2 w-full" value="{{ old('expiry_date') }}">
            </div>
            <div class="mb-3">
                <label>File chứng chỉ</label>
                <input type="file" name="certificate_file" class="border p-2 w-full" accept=".pdf, .jpg, .jpeg, .png" value="{{ old('certificate_file') }}">
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded" title="Tải lên">Tải lên</button>
        </form>
        <hr class="my-4">
        <h3 class="font-bold text-lg">Danh sách chứng chỉ</h3>
        <table class="w-full border">
            <tr>
                <td style="font-weight:bold;">Tên chứng chỉ</td>
                <td style="font-weight:bold;">Ngày cấp</td>
                <td style="font-weight:bold;">Ngày hết hạn</td>
                <td style="font-weight:bold;">File</td>
            </tr>
            @forelse($employee->certificates as $c)
            <tr>
                <td>{{ $c->certificate_name }}</td>
                <td>
                    {{ $c->issue_date ? date('d/m/Y', strtotime($c->issue_date)) : '' }}
                </td>
                <td>
                    {{ $c->expiry_date ? date('d/m/Y', strtotime($c->expiry_date)) : '' }}
                </td>
                <td>
                    @if($c->certificate_file == '')
                    <a href="" style="color:blue; font-weight:bold;" onclick="return alert('File không tồn tại')" title="Xem file">Xem
                        file</a>
                    @else
                    <a href="/hcns/employees/certificate/view/{{ $c->id }}" target="_blank"
                        style="color:blue; font-weight:bold;" title="Xem file">Xem
                        file</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr class="border-b">
                <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
            </tr>
            @endforelse
        </table>
    </div>
</body>
</html>

@endsection