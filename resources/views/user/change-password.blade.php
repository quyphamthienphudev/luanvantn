@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')

<div class="bg-white p-6 rounded-xl shadow w-1/2">

    @if(session('error'))
        <div class="text-red-600 mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="text-green-600 mb-4">
            {{ session('success') }}
        </div>
    @endif


    @if($errors->any())
    <div class="text-red-600 mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2">Mật khẩu hiện tại</label>
            <input type="password" name="current_password"
                   class="w-full px-4 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-2">Mật khẩu mới</label>
            <input type="password" name="new_password"
                   class="w-full px-4 py-2 border rounded">
        </div>
        
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Đổi mật khẩu
        </button>
    </form>

</div>

@endsection