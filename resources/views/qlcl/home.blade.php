@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Trang chủ</title>
</head>

<body>
    <div @class(['container', 'mt-4'])>
        <div @class(['row', 'g-4'])>
            <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>Số lượng đơn nghỉ phép</h1>
            <div @class(['grid', 'grid-cols-4', 'gap-6'])>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng đơn nghỉ phép đã duyệt</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $countLeaveRequestApproved }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng đơn nghỉ phép đang chờ</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $countLeaveRequestPending }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng đơn nghỉ phép từ chối</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $countLeaveRequestRejected }}</p>
                </div>
                <div @class(['flex-1', 'p-8'])>
                    @yield('content')
                </div>
            </div>
            <br>
            <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>Số lượng nhân viên chấm công</h1>
            <div @class(['grid', 'grid-cols-4', 'gap-6'])>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng nhân viên chấm công hôm nay</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $countAttendanceToday }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng nhân viên chấm công tháng này</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $countAttendanceForMonth }}</p>
                </div>
                <div @class(['flex-1', 'p-8'])>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@endsection