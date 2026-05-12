<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý nhân sự</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-2xl shadow-2xl w-96">
    
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
        Hệ thống quản lý nhân sự
    </h2>

    @if(session('error'))
        <div class="text-red-500 text-center mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-4">
            <input type="email" name="email" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                   placeholder="Email">
        </div>

        <div class="mb-4">
            <input type="password" name="password" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                   placeholder="Password">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Đăng nhập
        </button>
    </form>

</div>

</body>
</html>