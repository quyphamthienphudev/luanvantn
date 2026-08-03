@extends('layouts.app')

@section('title','Thêm hợp đồng lao động')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/contracts/store" method="post" class="bg-white p-6 rounded shadow w-1/2"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label>Mã hợp đồng</label>
            <input type="text" name="contract_code" class="w-full border p-2 rounded" value="{{ old('contract_code') }}">
            @error('contract_code')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Nhân viên</label>
            <select name="employee_id" id="employee_id" class="w-full border p-2 rounded">
                @foreach($employees as $employee)
                <option value="{{ $employee->id }}">
                    {{ $employee->full_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input type="text" id="employee_code" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Loại hợp đồng</label>
            <select name="contract_type" class="w-full border p-2 rounded">
                <option value="probation">Hợp đồng thử việc</option>
                <option value="fixed_term">Hợp đồng xác định thời hạn</option>
                <option value="indefinite">Hợp đồng không xác định thời hạn</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày bắt đầu</label>
            <input type="date" name="start_date" class="w-full border p-2 rounded" value="{{ old('start_date') }}">
            @error('start_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="w-full border p-2 rounded" value="{{ old('end_date') }}">
            @error('end_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Mức lương</label>
            <input type="text" name="salary" class="w-full border p-2 rounded" placeholder="Mức lương" value="{{ old('salary') }}">
            @error('salary')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>File hợp đồng</label>
            <input type="file" name="contract_file" class="w-full border p-2 rounded" accept=".pdf,.doc,.docx">
            @error('contract_file')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label>Ghi chú hợp đồng</label>
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <textarea name="description" class="w-full border p-2 rounded" rows="10" cols="40">{{ old('description') }}</textarea>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">Lưu</button>
    </form>
    <!-- javascript cập nhật mã nhân viên khi thay đổi chọn nhân viên -->
    <script>
        const employees = @json($employees);

        const employeeSelect = document.getElementById('employee_id');
        const employeeCodeInput = document.getElementById('employee_code');

        function updateEmployeeCode() {
            let employeeId = employeeSelect.value;

            let employee = employees.find(
                item => item.id == employeeId
            );

            if (employee) {
                employeeCodeInput.value = employee.employee_code;
            }
        }

        employeeSelect.addEventListener('change', updateEmployeeCode);

        updateEmployeeCode();
    </script>
</body>

</html>

@endsection