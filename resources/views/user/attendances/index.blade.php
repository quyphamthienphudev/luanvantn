@extends('layouts.app')

@section('content')
<title>Hệ thống quản lý nhân sự - Quản lý chấm công</title>
<div class="max-w-6xl mx-auto mt-6">
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
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Xác nhận chấm công
                </button>
            </form>
    @else
            <span
                class="bg-green-600 text-white px-4 py-2 rounded">
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
                    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    Xác nhận chấm công
                </button>
            </form>
    @elseif($attendance && $attendance->check_out)

            <span
                class="bg-green-600 text-white px-4 py-2 rounded">
                Đã xác nhận
            </span>
    @else
            <span class="text-red-600">
                Vui lòng chấm công vào làm trước.
            </span>
    @endif
</div>
@endsection
