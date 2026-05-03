<!DOCTYPE html>
<html>
<head>
<title>Kết quả tuần 02</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Kết quả tuần 02</h2>

<form method="GET" action="/users">

<div class="row mb-3">
<h4>Tìm kiếm</h4>
<div class="col-md-4">
<input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Tìm theo id hoặc theo tên">
</div>

<div class="col-md-3">
<select name="sort" class="form-control">

<option value="id">Sắp xếp theo ID</option>
<option value="name">Sắp xếp theo tên</option>

</select>
</div>

<div class="col-md-2">
<button class="btn btn-primary">Tìm kiếm</button>
</div>

</div>

</form>

<h4>Thêm User</h4>

<form method="POST" action="/users/add">

@csrf

<div class="row mb-3">

<div class="col">
<input type="text" name="id" class="form-control" placeholder="ID">
</div>

<div class="col">
<input type="text" name="name" class="form-control" placeholder="Tên">
</div>

<div class="col">
<button class="btn btn-success">Thêm</button>
</div>

</div>

</form>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th width="200">Hành động</th>
</tr>

@forelse($users as $u)

<tr>

<td>
{{ $u->id }}
</td>

<td>

<form method="POST" action="/users/update/{{ $u->id }}">

@csrf

<div class="input-group">

<input type="text" name="name" value="{{ $u->name }}" class="form-control">

<button class="btn btn-warning">Cập nhật</button>

</div>

</form>

</td>

<td>

<a href="/users/delete/{{ $u->id }}"
class="btn btn-danger"
onclick="return confirm('Bạn có muốn xóa user này ?')">

Xóa

</a>

</td>

</tr>

@empty
<td colspan="2" class="text-center">
    Không có dữ liệu
</td>
<td></td>

@endforelse

</table>

</div>

</body>
</html>
