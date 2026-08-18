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
            <h1 @class(['text-2xl', 'font-bold', 'mb-6'])>
                Thống kê số lượng tài khoản
            </h1>
            <!-- ACCOUNTS -->
            <div @class(['grid', 'grid-cols-4', 'gap-6'])>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng tài khoản đang hoạt động</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $a_active }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng tài khoản tạm dừng</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $a_suspended }}</p>
                </div>
                <div @class(['bg-white', 'p-6', 'rounded-xl', 'shadow'])>
                    <h3 @class(['text-gray-500'])>Số lượng tài khoản tất cả</h3>
                    <p @class(['text-3xl', 'font-bold', 'text-blue-600'])>{{ $accounts }}</p>
                </div>
                <!-- CONTENT -->
                <div @class(['flex-1', 'p-8'])>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>

@endsection