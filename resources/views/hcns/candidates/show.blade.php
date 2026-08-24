@extends('layouts.app')
@section('title','Chi tiết hồ sơ ứng viên')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết hồ sơ ứng viên</title>
</head>

<body>
    <a href="/hcns/candidates" title="← Quay lại">← Quay lại</a>
    <div @class(['bg-white', 'p-6'])>
        <p>Mã hồ sơ: {{ $candidate->candidate_id }}</p>
        <p>Họ và tên: {{ $candidate->full_name }}</p>
        <p>Tên: {{ $candidate->first_name }}</p>
        <p>Họ: {{ $candidate->last_name }}</p>
        <p>
            Giới tính:
            @if($candidate->gender == 'male')
            Nam
            @else
            Nữ
            @endif
        </p>
        <p>Ngày sinh: {{ $candidate->date_of_birth ? date('d/m/Y', strtotime($candidate->date_of_birth)) : '' }}</p>
        <p>SĐT: {{ $candidate->phone }}</p>
        <p>Học vấn: {{ $candidate->education }}</p>
        <p>Email: {{ $candidate->email }}</p>
        <p>Địa chỉ: {{ $candidate->address }}, {{ $candidate->street }}, {{ $candidate->ward }}, {{ $candidate->province }}</p>
    </div>
</body>

</html>
@endsection