@extends('layouts.dashboard')

@section('title', 'Employees')

@section('content')
    <div class="page-content">

        <!-- Alerts -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please check the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Employees</h2>
                <p class="text-muted">Manage your employees</p>
            </div>
            <a href="{{ route('employee.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add Employee
            </a>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table(attributes: ['class' => 'table table-striped dt-responsive']) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
