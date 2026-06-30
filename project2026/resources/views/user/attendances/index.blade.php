@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý chấm công</title>
</head>

<body>
    <div class="max-w-md mx-auto mt-4 px-4">
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Chấm công vào làm</h2>
        </div>

        @if(!$attendance || !$attendance->check_in)
        <form action="/attendances/checkin" method="POST">
            @csrf
            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-lg text-lg font-semibold hover:bg-blue-700">
                Xác nhận chấm công
            </button>
        </form>
        @else
        <span class="block w-full text-center bg-green-600 text-white py-4 rounded-lg text-lg font-semibold">
            Đã xác nhận
        </span>
        @endif

        <br><br>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Chấm công tan ca</h2>
        </div>

        @if($attendance && !$attendance->check_out)
        <form action="/attendances/checkout" method="POST">
            @csrf
            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-lg text-lg font-semibold hover:bg-blue-700">
                Xác nhận chấm công
            </button>
        </form>
        @elseif($attendance && $attendance->check_out)
        <span class="block w-full text-center bg-green-600 text-white py-4 rounded-lg text-lg font-semibold">
            Đã xác nhận
        </span>
        @else
        <span class="text-red-600">
            Vui lòng chấm công vào làm trước.
        </span>
        @endif
    </div>
</body>

</html>

@endsection