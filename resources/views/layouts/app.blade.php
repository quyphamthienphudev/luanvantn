<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- script biểu đồ  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            HỆ THỐNG QUẢN LÝ NHÂN SỰ
        </div>

        <nav class="flex-1 p-4 space-y-2">

            @if(auth()->user()->role->name === 'admin')
            <a href="/admin/home" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/home" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>
            @endif

            @if(auth()->user()->role->name === 'qlcl')
            <a href="/qlcl/home" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>
            @endif

            @if(auth()->user()->role->name === 'httt')
            <a href="/httt/home" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>
            @endif

            @if(auth()->user()->role->name === 'user')
            <a href="/home" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>
            @endif

            @if(auth()->user()->role->name === 'admin')
            <a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-blue-700">
                Báo cáo thống kê
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/employees" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nhân viên
            </a>
            @endif

             @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/contracts" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý hợp đồng lao động
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/departments" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý phòng ban
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/positions" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý công việc
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/candidates" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý hồ sơ ứng viên
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/payrolls" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý lương
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/attendances" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý chấm công
            </a>
            @endif

            @if(auth()->user()->role->name === 'hcns')
            <a href="/hcns/leave" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nghỉ phép
            </a>
            @endif

            @if(auth()->user()->role->name === 'qlcl')
            <a href="/qlcl/employees" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nhân viên
            </a>
            @endif

            @if(auth()->user()->role->name === 'qlcl')
            <a href="/qlcl/leave" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nghỉ phép
            </a>
            @endif

            @if(auth()->user()->role->name === 'qlcl')
            <a href="/qlcl/attendances" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý chấm công
            </a>
            @endif
            
            @if(auth()->user()->role->name === 'httt')
                <a href="/httt/accounts" class="block px-4 py-2 rounded hover:bg-blue-700">
                    Quản lý tài khoản
                </a>
            @endif

            @if(auth()->user()->role->name === 'httt')
                <a href="/httt/roles" class="block px-4 py-2 rounded hover:bg-blue-700">
                    Quản lý quyền truy cập
                </a>
            @endif

            @if(auth()->user()->role->name === 'user')
            <a href="/payrolls" class="block px-4 py-2 rounded hover:bg-blue-700">
                Xem lương
            </a>
            @endif

            @if(auth()->user()->role->name === 'user')
            <a href="/attendances" class="block px-4 py-2 rounded hover:bg-blue-700">
                Chấm công
            </a>
            @endif
            @if(auth()->user()->role->name === 'user')
            <a href="/leave" class="block px-4 py-2 rounded hover:bg-blue-700">
                Đăng kí nghỉ phép
            </a>
            @endif

            <a href="/profile" class="block px-4 py-2 rounded hover:bg-blue-700">
                Cập nhật thông tin
            </a>

            <a href="/change-password" class="block px-4 py-2 rounded hover:bg-blue-700">
                Đổi mật khẩu
            </a>

        </nav>

        <div class="p-4 border-t border-blue-700">
            <a href="/logout" class="block text-center bg-red-500 hover:bg-red-600 py-2 rounded">
                Đăng xuất
            </a>
        </div>

    </aside>

    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">
                @yield('title')
            </h1>

            <div class="text-gray-600">
                Xin chào, <strong>{{ auth()->user()->name }}</strong>
            </div>
        </div>

        @yield('content')

    </main>

</div>

</body>
</html>
