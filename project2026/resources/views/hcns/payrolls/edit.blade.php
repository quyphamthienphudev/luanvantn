@extends('layouts.app')

@section('title', 'Sửa bảng lương')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Sửa bảng lương</title>
</head>

<body>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Sửa bảng lương</h2>
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif
        <form action="/hcns/payrolls/update/{{ $payroll->id }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nhân viên</label>
                <select name="employee_id" id="employee_id" class="w-full border rounded px-3 py-2">
                    @foreach($employees as $e)
                    <option value="{{ $e->id }}" {{ $payroll->employee_id == $e->id ? 'selected' : '' }}>
                        {{ $e->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Mã nhân viên</label>
                <input type="text" id="employee_code" class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Công việc</label>
                <input type="text" id="position_name" class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Tháng</label>
                    <select name="month" class="w-full border rounded px-3 py-2">
                        @for($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $payroll->month == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Năm</label>
                    <select name="year" class="w-full border rounded px-3 py-2">
                        @for($i = 2001; $i <= 2099; $i++) <option value="{{ $i }}" {{ $payroll->year == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phụ cấp (VNĐ)</label>
                <input type="text" name="allowance" value="{{ $request->allowance }}" class="w-full border p-2 rounded">
                @error('allowance')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Thưởng (VNĐ)</label>
                    <input type="number" name="" class="w-full border rounded px-3 py-2 bg-gray-100"
                        value="{{ $payroll->bonus }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Khấu trừ (VNĐ)</label>
                    <input type="number" name="" class="w-full border rounded px-3 py-2 bg-gray-100"
                        value="{{ $payroll->deduction }}" readonly>
                </div>
            </div>

            <div class="flex gap-2 justify-end">
                <a href="/hcns/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded" title="Huỷ">Huỷ</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" title="Cập nhật">Cập nhật</button>
            </div>
        </form>
    </div>
    <!-- javascript cập nhật mã nhân viên khi thay đổi chọn nhân viên -->
    <script>
        const employees = @json($employees);

        const employeeSelect = document.getElementById('employee_id');
        const employeeCodeInput = document.getElementById('employee_code');
        const positionNameInput = document.getElementById('position_name');

        function updateEmployeeCode() {
            let employeeId = employeeSelect.value;

            let employee = employees.find(
                item => item.id == employeeId
            );

            if (employee) {
                employeeCodeInput.value = employee.employee_code;
                positionNameInput.value = employee.position_name;
            }
        }

        employeeSelect.addEventListener('change', updateEmployeeCode);

        updateEmployeeCode();
    </script>
</body>

</html>

@endsection