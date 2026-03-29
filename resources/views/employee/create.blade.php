@extends('layouts.dashboard')

@section('title', 'Add Employee')

@section('content')
    <div class="page-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Create Employee</h3>
                        <p class="text-subtitle text-muted">Fill in the form below to add a new employee.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                        <div class="card-header">
                            <h4 class="card-title">Employee Information</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-light-danger color-danger">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Please check the form input below.
                                        <ul class="mt-2 mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('employee.store') }}" class="form form-vertical">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="full_name" class="form-label">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('full_name') is-invalid @enderror"
                                                    id="full_name" name="full_name" value="{{ old('full_name') }}"
                                                    placeholder="e.g. John Doe" required>
                                                @error('full_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email') }}"
                                                    placeholder="name@company.com" required>
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Phone <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                    name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                                                    required>
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="department_id" class="form-label">Department <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select @error('department_id') is-invalid @enderror"
                                                    id="department_id" name="department_id" required>
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $dept)
                                                        <option value="{{ $dept->id }}"
                                                            {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                                            {{ $dept->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="role_id" class="form-label">Role <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select @error('role_id') is-invalid @enderror"
                                                    id="role_id" name="role_id" required>
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="active"
                                                        {{ old('status') == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                    <option value="on_leave"
                                                        {{ old('status') == 'on_leave' ? 'selected' : '' }}>
                                                        On Leave</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="salary" class="form-label">Salary <span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control @error('salary') is-invalid @enderror"
                                                    id="salary" name="salary" value="{{ old('salary') }}"
                                                    step="0.01" placeholder="0.00" required>
                                                @error('salary')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="date_of_birth" class="form-label">Date of Birth <span
                                                        class="text-danger">*</span></label>
                                                <input type="date"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    id="date_of_birth" name="date_of_birth"
                                                    value="{{ old('date_of_birth') }}" required>
                                                @error('date_of_birth')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="hire_date" class="form-label">Hire Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date"
                                                    class="form-control @error('hire_date') is-invalid @enderror"
                                                    id="hire_date" name="hire_date" value="{{ old('hire_date') }}"
                                                    required>
                                                @error('hire_date')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                    placeholder="Complete address">{{ old('address') }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end gap-2">
                                            <a href="{{ route('employee.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Save
                                                Employee</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
