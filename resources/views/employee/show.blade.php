@extends('layouts.dashboard')

@section('title', 'Employee Detail')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Employee Detail</h5>
                        <div>
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-light">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Full Name</h6>
                                <p class="fw-medium">{{ $employee->full_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Email</h6>
                                <p class="fw-medium">{{ $employee->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Phone</h6>
                                <p class="fw-medium">{{ $employee->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Department</h6>
                                <p class="fw-medium">{{ $employee->department->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Role</h6>
                                <p class="fw-medium">{{ $employee->role->name ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                @if ($employee->status == 'active')
                                    <p><span class="badge bg-success">Active</span></p>
                                @elseif ($employee->status == 'inactive')
                                    <p><span class="badge bg-secondary">Inactive</span></p>
                                @else
                                    <p><span class="badge bg-warning">On Leave</span></p>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Date of Birth</h6>
                                <p class="fw-medium">{{ $employee->date_of_birth->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Hire Date</h6>
                                <p class="fw-medium">{{ $employee->hire_date->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Salary</h6>
                                <p class="fw-medium">Rp{{ number_format($employee->salary, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Address</h6>
                                <p class="fw-medium">{{ $employee->address ?? '-' }}</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Additional Info -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Created At</h6>
                                <p class="small">{{ $employee->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Updated At</h6>
                                <p class="small">{{ $employee->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back to List</a>
                            <form method="POST" action="{{ route('employee.destroy', $employee->id) }}"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
