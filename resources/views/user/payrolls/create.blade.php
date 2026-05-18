@extends('layouts.app')

@section('title', 'Tạo bảng lương')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Tạo bảng lương mới</h2>
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="/payrolls" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nhân viên</label>
            <select name="employee_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Chọn nhân viên --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->employee_code }} - {{ $employee->full_name }} ({{ $employee->position_name ?? 'N/A' }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tháng</label>
                <select name="month" class="w-full border rounded px-3 py-2" required>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">Tháng {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Năm</label>
                <select name="year" class="w-full border rounded px-3 py-2" required>
                    @for($i = 2020; $i <= date('Y')+1; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Thưởng (VNĐ)</label>
                <input type="number" name="bonus" class="w-full border rounded px-3 py-2" value="0" min="0">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Khấu trừ (VNĐ)</label>
                <input type="number" name="deduction" class="w-full border rounded px-3 py-2" value="0" min="0">
            </div>
        </div>
        
        <div class="flex gap-2 justify-end">
            <a href="/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded">Hủy</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
        </div>
    </form>
</div>
@endsection