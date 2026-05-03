<!DOCTYPE html>
<html>
<head>

<title>Kết quả tuần 02</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h3>Chi tiết User</h3>

<table class="table table-bordered">
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

<a href="/users" class="btn btn-primary">Quay lại</a>

</div>

</body>
</html>
