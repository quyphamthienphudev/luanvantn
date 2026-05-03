<!-- Giữ nguyên phần link CSS và Style của bạn -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { background-color: #f8f9fa; }
    .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .card-header { background: linear-gradient(45deg, #007bff, #0056b3); color: white; border-radius: 15px 15px 0 0 !important; font-weight: bold; }
    .btn-primary { border-radius: 8px; padding: 10px 25px; transition: all 0.3s; font-weight: 600; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,123,255,0.3); }
    .table { background: white; border-radius: 10px; overflow: hidden; }
    .badge { padding: 8px 12px; border-radius: 20px; }
    .form-select, .form-control { border-radius: 8px; padding: 10px; }  
    .is-invalid { animation: shake 0.2s ease-in-out 0s 2; }
    @keyframes shake {
        0% { margin-left: 0rem; } 25% { margin-left: 0.5rem; } 75% { margin-left: -0.5rem; } 100% { margin-left: 0rem; }
    }
</style>

@extends('layouts.app')

@section('title', 'Quản lý nghỉ phép')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="rounded mt-6">
    <div class="row">
        <!-- FORM ĐĂNG KÝ -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header py-3 text-center">
                    Tạo đơn xin nghỉ phép
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('leave.store') }}" method="POST">
                        @csrf
                        <!-- NHÂN VIÊN -->
                        <div class="mb-3">
                            <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
                                <option value="">-- Chọn nhân viên --</option>
                                @foreach($allEmployees as $emp)
                                    <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->full_name }} ({{ $emp->employee_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>
                        <!-- NGÀY BẮT ĐẦU & KẾT THÚC -->
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Từ ngày <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date" 
                                       class="form-control @error('start_date') is-invalid @enderror" 
                                       value="{{ old('start_date') }}" 
                                       min="{{ date('Y-m-d') }}"> 
                                @error('start_date') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Đến ngày <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" id="end_date" 
                                       class="form-control @error('end_date') is-invalid @enderror" 
                                       value="{{ old('end_date') }}"
                                       min="{{ date('Y-m-d') }}">
                                @error('end_date') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- LÝ DO -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase text-secondary">Lý do xin nghỉ phép<span class="text-danger"> *</span></label>
                            <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" 
                                      rows="4" >{{ old('reason') }}</textarea>
                            @error('reason') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary shadow">
                                Gửi đơn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    Lịch sử tạo đơn xin nghỉ phép
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light text-uppercase small fw-bold">
                                <tr>
                                    <th class="ps-4 py-3 text-secondary">Thời gian</th>
                                    <th class="text-secondary">Nhân viên</th>
                                    <th class="text-secondary">Trạng thái</th>
                                    <th class="text-secondary text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leaves as $leave)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y') }}</div>
                                        <div class="text-muted small">đến {{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y') }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $leave->employee->full_name ?? 'N/A' }}</div>
                                        <small class="text-muted">Lý do: {{ $leave->reason }}</small>
                                    </td>
                                    <td>
                                        @if($leave->status == 'pending')
                                            <span class="badge bg-warning text-dark status-badge"><i class="fas fa-spinner fa-spin me-1"></i> Chờ duyệt</span>
                                        @elseif($leave->status == 'approved')
                                            <span class="badge bg-success shadow-sm"><i class="fas fa-check-circle me-1"></i> Đồng ý</span>
                                        @else
                                            <span class="badge bg-danger shadow-sm"><i class="fas fa-times-circle me-1"></i> Từ chối</span>
                                        @endif
                                    </td>
                                    <td class="text-center pe-4">
                                        @if($leave->status == 'pending')
                                            <a href="{{ route('leave.edit', $leave->id) }}" class="btn btn-sm btn-outline-primary shadow-sm px-3">
                                                <i class="fas fa-edit me-1"></i> Sửa
                                            </a>
                                        @else
                                            <span class="text-muted small fw-italic"><i class="fas fa-lock"></i> Đã hoàn tất</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-25"></i>
                                        Bạn chưa tạo đơn xin nghỉ phép nào.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    startDateInput.addEventListener('change', function() {
        if (this.value) {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        }
    });
</script>
