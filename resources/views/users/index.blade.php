<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tuần 3</title>
</head>

<body>
    <form method="GET" action="/users">
    @csrf
        <h4>Tìm kiếm</h4>
        <input type="text" name="search" value="{{ $search }}"
            placeholder="Tìm theo id hoặc theo tên">
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
            <th>ID</th>
            <th>Name</th>
            <th width="200">Hành động</th>
        </tr>
        @foreach($users as $u)
        <tr>
            <td>
                {{ $u->id }}
            </td>
            <td>
                <form method="POST" action="/users/update/{{ $u->id }}">
                @csrf
                    <input type="text" name="name" value="{{ $u->name }}">
                    <button>Cập nhật</button>
                </form>
            </td>
            <td>
                <a href="/users/delete/{{ $u->id }}">
                    Xóa
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>