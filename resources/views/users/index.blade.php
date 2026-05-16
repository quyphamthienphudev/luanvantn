@section('content')
<form method="GET" action="/users">
    @csrf
    <h4>Tìm kiếm</h4>
    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm theo id hoặc theo tên">
    <select name="sort">
        <option value="id">Sắp xếp theo ID</option>
        <option value="name">Sắp xếp theo tên</option>
    </select>
    <button>Tìm kiếm</button>
</form>
<h4>Thêm user</h4>
<form method="POST" action="/users/add">
    @csrf
    <input type="text" name="id" placeholder="ID">
    <input type="text" name="name" placeholder="Tên">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="phone" placeholder="Điện thoại">
    <button>Thêm</button>
</form>
<br>
<!-- success -->
@if(session('success'))
{{ session('success') }}
@endif
<!-- error -->
@if(session('error'))
{{ session('error') }}
@endif
<!--  -->
<br>
<br>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Hành động</td>
    </tr>
    @foreach($users as $u)
    <tr>
        <td>
            {{ $u->id }}
        </td>
        <form method="POST" action="/users/update/{{ $u->id }}">
            @csrf
            <td>
                <input type="text" name="name" value="{{ $u->name }}">
            </td>
            <td>
                <input type="text" name="email" value="{{ $u->email }}">
            </td>
            <td>
                <input type="text" name="phone" value="{{ $u->phone }}">
            </td>
            <td>
                <button>Cập nhật</button>
        </form>
        <a href="/users/delete/{{ $u->id }}">
            Xóa
        </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
