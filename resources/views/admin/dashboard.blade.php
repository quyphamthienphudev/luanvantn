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
                Tổng nhân viên
            </h1>
            <!-- EMPLOYEES -->
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Tổng nhân viên</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $working }}</p>
            </div>
            <!-- CONTENT -->
            <div class="flex-1 p-8">
                @yield('content')
            </div>
        </div>
        <br>
            <h1 class="text-2xl font-bold mb-6">
                Tổng chi phí lương
            </h1>   
            <form method="GET" action="{{ url('/admin/dashboard') }}" class="bg-white p-6 rounded shadow w-1/2">
                @csrf
                @if(session('error_year'))
                <p class="text-red-500 text-sm">{{ session('error_year') }}</p>
                @endif
                @if(session('error_month'))
                <p class="text-red-500 text-sm">{{ session('error_month') }}</p>
                @endif
            <!-- Chọn năm -->
                <div class="mb-4">
                    <label>Năm</label>
                    <select name="year" class="w-full border p-2 rounded">
                        @for($i=2000;$i<=2099;$i++)
                        <option value="{{ $i }}">
                            Năm {{ $i }}
                        </option>
                        @endfor
                    </select>
                </div>
            <!-- Button -->
                <button type="submit" name="filter_year" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Thống kê theo năm
                </button>
            </form>
        <br>
        <div class="grid grid-cols-4 gap-6">
            @if(!is_null($totalYearSalary))
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Tổng lương năm {{ $year }}</h3>
                <p class="text-3xl font-bold text-green-600">{{ $totalYearSalary }} VNĐ</p>
            </div>
            @endif
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
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Tỉ lệ nghỉ phép
        </h1>
        <div class="bg-white p-6 rounded shadow w">
            <canvas id="leaveChart" style="max-height: 500px;"></canvas>
        </div>
        <script>
            const ctxLeave = document.getElementById('leaveChart').getContext('2d');
            const leaveChart = new Chart(ctxLeave, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($leaveLabels) !!},
                    datasets: [{
                        data: {!! json_encode($leaveData) !!},
                        borderWidth: 1,
                        backgroundColor: [
                            '#ffc107', // chờ duyệt
                            '#28a745', // đã duyệt
                            '#dc3545'  // từ chối
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Thống kê tỉ lệ nghỉ phép'
                        },
                        // ===== HIỂN THỊ % =====
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let data = context.chart.data.datasets[0].data;
                                let total = data.reduce((a, b) => a + b, 0);
                                let value = context.raw;
                                if(total === 0) return '0%';
                                let percentage = (value / total * 100).toFixed(1);
                                return context.label + ': ' + percentage + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, context) {
                            let data = context.chart.data.datasets[0].data;
                            let total = data.reduce((a, b) => a + b, 0);
                            if(total === 0) return '0%';
                            let percentage = (value / total * 100).toFixed(1);
                            return percentage + '%';
                        }
                    }
                    }
                },
                plugins: [ChartDataLabels] // kích hoạt plugin
            });
        </script>
        </div>
    </div>
</body>
</html>

@endsection