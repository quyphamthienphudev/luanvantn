@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Trang chủ</title>
</head>

<body>
    <div @class(['container', 'mt-4'])>
        <div @class(['row', 'g-4'])>
            <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>Thống kê số lượng nhân viên</h1>
            <div @class(['grid', 'grid-cols-4', 'gap-6'])>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng nhân viên đang làm việc</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $e_working }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng nhân viên đã nghỉ việc</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $e_resign }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng nhân viên tất cả</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $employees }}</p>
                </div>
                <div @class(['flex-1', 'p-8'])>
                    @yield('content')
                </div>
            </div>
            <br>
            <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>Thống kê số lượng nhân viên theo phòng ban</h1>
            <div @class(['bg-white', 'p-6', 'rounded', 'shadow', 'w'])>
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