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
                <h3 class="text-gray-500">Số lượng nhân viên tạo bởi Admin</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $e_admin }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng nhân viên tạo bởi User</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $e_user }}</p>
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
        <div class="row g-4">
            <h1 class="text-2xl font-bold mb-6">
                Số lượng phòng ban
            </h1>
            <!-- departments -->
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tạo bởi Admin</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $d_admin }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tạo bởi User</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $d_user }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tất cả</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $departments }}</p>
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
    </div>
</body>
</html>

@endsection