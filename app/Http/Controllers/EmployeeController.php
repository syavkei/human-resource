<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use App\DataTables\EmployeeDataTable;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of all employees
     */
    public function index(EmployeeDataTable $dataTable)
    {
        try {
            return $dataTable->render('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to retrieve employees: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new employee
     */
    public function create()
    {
        try {
            $departments = Department::all();
            $roles = Role::all();

            return view('employee.create', compact('departments', 'roles'));
        } catch (\Exception $e) {
            return redirect()->route('employee.index')
                ->with('error', 'Failed to load form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created employee
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|string|max:20|unique:employees,phone',
                'department_id' => 'required|exists:departments,id',
                'role_id' => 'required|exists:roles,id',
                'address' => 'nullable|string|max:500',
                'date_of_birth' => 'required|date|before:today',
                'hire_date' => 'required|date|before_or_equal:today',
                'status' => 'required|in:active,inactive,on_leave',
                'salary' => 'required|numeric|min:0'
            ]);

            // Create employee
            Employee::create($validated);

            return redirect()->route('employee.index')
                ->with('success', 'Employee created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create employee: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified employee
     */
    public function show($id)
    {
        try {
            $employee = Employee::with(['department', 'role'])->findOrFail($id);

            return view('employee.show', compact('employee'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('employee.index')
                ->with('error', 'Employee not found.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to retrieve employee: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified employee
     */
    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $departments = Department::all();
            $roles = Role::all();

            return view('employee.edit', compact('employee', 'departments', 'roles'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('employee.index')
                ->with('error', 'Employee not found.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to load form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified employee
     */
    public function update(Request $request, $id)
    {
        try {
            // Find employee
            $employee = Employee::findOrFail($id);

            // Validate input
            $validated = $request->validate([
                'full_name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:employees,email,' . $id,
                'phone' => 'sometimes|required|string|max:20|unique:employees,phone,' . $id,
                'department_id' => 'sometimes|required|exists:departments,id',
                'role_id' => 'sometimes|required|exists:roles,id',
                'address' => 'nullable|string|max:500',
                'date_of_birth' => 'sometimes|required|date|before:today',
                'hire_date' => 'sometimes|required|date|before_or_equal:today',
                'status' => 'sometimes|required|in:active,inactive,on_leave',
                'salary' => 'sometimes|required|numeric|min:0'
            ]);

            // Update employee
            $employee->update($validated);

            return redirect()->route('employee.show', $employee->id)
                ->with('success', 'Employee updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('employee.index')
                ->with('error', 'Employee not found.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update employee: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete the specified employee (soft delete)
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            // Soft delete
            $employee->delete();

            return redirect()->route('employee.index')
                ->with('success', 'Employee deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('employee.index')
                ->with('error', 'Employee not found.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }
}
