@extends('layouts.app')

@section('title','Quản lý hợp đồng lao động')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts/create" class="bg-blue-600 text-white px-4 py-2 rounded" title="Thêm hợp đồng lao động">
        Thêm hợp đồng lao động
    </a>
    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã hợp đồng</th>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Loại hợp đồng</th>
                    <th class="p-3">Ngày bắt đầu</th>
                    <th class="p-3">Ngày kết thúc</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="p-3">Gia hạn</th>
                    <th class="p-3">Thanh lý</th>
                    <th class="p-3">Xem hợp đồng</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $c)
                <tr class="border-b">
                    <td class="p-3">{{ $c->contract_code }}</td>
                    <td class="p-3">{{ $c->employee->full_name }}</td>
                    <td class="p-3">
                        @if($c->contract_type == 'probation')
                        Hợp đồng thử việc
                        @endif
                        @if($c->contract_type == 'fixed_term')
                        Hợp đồng xác định thời hạn
                        @endif
                        @if($c->contract_type == 'indefinite')
                        Hợp đồng không xác định thời hạn
                        @endif
                    </td>
                    <td class="p-3">
                        {{ $c->start_date ? date('d/m/Y', strtotime($c->start_date)) : '' }}
                    </td>
                    <td class="p-3">
                        {{ $c->end_date ? date('d/m/Y', strtotime($c->end_date)) : 'Không có' }}
                    </td>
                    <td class="p-3">
                        @if($c->status == 'active')
                        Còn hạn
                        @endif
                        @if($c->status == 'expired')
                        Đã hết hạn
                        @endif
                        @if($c->status == 'terminated')
                        Đã thanh lý
                        @endif
                    </td>
                    <td class="p-3">
                        <a href="/hcns/contracts/edit/{{ $c->id }}" style="color:blue; font-weight:bold;" title="Gia hạn">Gia hạn</a>
                    </td>
                    <td class="p-3">
                        <a href="/hcns/contracts/terminate/{{ $c->id }}" style="color:red; font-weight:bold;" title="Thanh lý">Thanh lý</a>
                    </td>
                    <td class="p-3">
                        @if($c->contract_file)
                        <a href="/hcns/contracts/view/{{ $c->id }}" class="bg-green-600 text-white px-3 py-1 rounded" title="Xem" target="_blank">Xem</a>
                        @else
                        <a href="" class="bg-green-600 text-white px-3 py-1 rounded" onclick="return alert('File không tồn tại')" title="Xem">Xem</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="border-b">
                    <td colspan="8" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>

@endsection