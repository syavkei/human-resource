@extends('layouts.dashboard')

@section('title', 'Employee Detail')

@section('content')
    <div class="page-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Employee Detail</h3>
                        <p class="text-subtitle text-muted">Review complete employee information.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Employee Information</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-light-success color-success">
                                        <i class="bi bi-check-circle"></i>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form class="form form-vertical">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Full Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->full_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Email</label>
                                                <input type="text" class="form-control" value="{{ $employee->email }}"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Phone</label>
                                                <input type="text" class="form-control" value="{{ $employee->phone }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Department</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->department->name ?? '-' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Role</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->role->name ?? '-' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Status</label>
                                                <input type="text" class="form-control"
                                                    value="{{ ucwords(str_replace('_', ' ', $employee->status ?? '-')) }}"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Date of Birth</label>
                                                <input type="date" class="form-control"
                                                    value="{{ optional($employee->date_of_birth)->format('Y-m-d') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Hire Date</label>
                                                <input type="date" class="form-control"
                                                    value="{{ optional($employee->hire_date)->format('Y-m-d') }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Salary</label>
                                                <input type="text" class="form-control"
                                                    value="Rp{{ number_format($employee->salary, 0, ',', '.') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label text-muted">Address</label>
                                                <textarea class="form-control" rows="4" readonly>{{ $employee->address ?? '-' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a href="{{ route('employee.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <a href="{{ route('employee.edit', $employee->id) }}"
                                        class="btn btn-primary me-1 mb-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
