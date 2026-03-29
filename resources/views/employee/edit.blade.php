@extends('layouts.dashboard')

@section('title', 'Edit Employee')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Employee</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Please check the errors below.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" value="{{ old('full_name', $employee->full_name) }}"
                                    required>
                                @error('full_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="mb-3">
                                <label for="department_id" class="form-label">Department *</label>
                                <select class="form-select @error('department_id') is-invalid @enderror" id="department_id"
                                    name="department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}"
                                            {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role *</label>
                                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id"
                                    name="role_id" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id', $employee->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth *</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', $employee->date_of_birth->format('Y-m-d')) }}" required>
                                @error('date_of_birth')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Hire Date -->
                            <div class="mb-3">
                                <label for="hire_date" class="form-label">Hire Date *</label>
                                <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                                    id="hire_date" name="hire_date"
                                    value="{{ old('hire_date', $employee->hire_date->format('Y-m-d')) }}" required>
                                @error('hire_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $employee->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active"
                                        {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive"
                                        {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                    <option value="on_leave"
                                        {{ old('status', $employee->status) == 'on_leave' ? 'selected' : '' }}>
                                        On Leave
                                    </option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary *</label>
                                <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                    id="salary" name="salary" value="{{ old('salary', $employee->salary) }}"
                                    step="0.01" required>
                                @error('salary')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update Employee</button>
                                <a href="{{ route('employee.show', $employee->id) }}"
                                    class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
