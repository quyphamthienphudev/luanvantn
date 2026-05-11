<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tuần 3</title>
</head>

<body>
    <h3>Chi tiết user</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        @foreach($user as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
        </tr>
        @endforeach
    </table>

    <a href="/users">Quay lại</a>
</body>

</html>