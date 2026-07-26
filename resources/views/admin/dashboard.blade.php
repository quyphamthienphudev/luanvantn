@extends('layouts.app')

@section('title', 'Thống kê')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Báo cáo thống kê</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row g-4">
            <h1 class="text-2xl font-bold mb-6">
                Số lượng nhân viên
            </h1>
            <!-- EMPLOYEES -->
            <div class="grid grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500">Số lượng nhân viên đang làm việc</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $e_working }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500">Số lượng nhân viên đã nghỉ việc</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $e_resign }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500">Số lượng nhân viên tất cả</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $employees }}</p>
                </div>
                <!-- CONTENT -->
                <div class="flex-1 p-8">
                    @yield('content')
                </div>
            </div>
            <br>
            <h1 class="text-2xl font-bold mb-6">
                Số lượng nhân viên theo phòng ban
            </h1>
            <div class="bg-white p-6 rounded shadow w">
                <canvas id="departmentChart" height="120"></canvas>
            </div>
            <script>
                const ctxDept = document.getElementById('departmentChart').getContext('2d');
                const departmentChart = new Chart(ctxDept, {
                    type: 'bar', // cột dọc
                    data: {
                        labels: {!! json_encode($deptLabels) !!},
                    datasets: [{
                        label: 'Số lượng nhân viên',
                        data: {!! json_encode($deptData) !!},
                borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                        plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                    text: 'Phòng ban'
                            }
                        },
                        y: {
                            beginAtZero: true,
                                title: {
                                display: true,
                                    text: 'Số lượng nhân viên'
                            },
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
            </script>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Tổng chi phí lương theo tháng và năm
        </h1>
        <form action="/admin/dashboard" method="get" class="bg-white p-6 rounded shadow w-1/2">
            @csrf
            <!-- Chọn tháng -->
            <div class="mb-4">
                <label>Tháng</label>
                <select name="month" class="w-full border p-2 rounded">
                    @for($i=1;$i<=12;$i++) <option value="{{ $i }}" {{ $month == $i ? 'selected' :'' }}>
                        Tháng {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            
            <!-- Chọn năm -->
            <div class="mb-4">
                <label>Năm</label>
                <select name="year" class="w-full border p-2 rounded">
                    @for($i=2001; $i<=2099; $i++) <option value="{{ $i }}" {{ $year == $i ? 'selected' :'' }}>
                        Năm {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Button -->
            <button name="filter_month"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Thống kê">
                Thống kê
            </button>

        </form>
        <br>
        <div class="bg-white p-6 rounded shadow w-1/2">
            @if(!is_null($totalMonthSalary))
                <h3 class="text-gray-500">Tổng lương tháng {{ $month }} / năm {{ $year }}</h3>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($totalMonthSalary) }} VNĐ</p>
            @endif
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Tổng chi phí lương theo năm
        </h1>
        <form action="/admin/dashboard" method="get" class="bg-white p-6 rounded shadow w-1/2">
            @csrf
            <!-- Chọn năm -->
            <div class="mb-4">
                <label>Năm</label>
                <select name="year" class="w-full border p-2 rounded">
                    @for($i=2001; $i<=2099; $i++) <option value="{{ $i }}" {{ $year == $i ? 'selected' :'' }}>
                        Năm {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Button -->
            <button name="filter_year"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Thống kê">
                Thống kê
            </button>

        </form>
        <br>
        <div class="bg-white p-6 rounded shadow w-1/2">
            @if(!is_null($totalYearSalary))
                <h3 class="text-gray-500">Tổng lương năm {{ $year }}</h3>
                <p class="text-3xl font-bold text-green-600">{{ number_format($totalYearSalary) }} VNĐ</p>
            @endif
        </div>
    </div>
</body>

</html>

@endsection