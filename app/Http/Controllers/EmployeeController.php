<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of all employees
     */
    public function index(Request $request)
    {
        try {
            $query = Employee::with(['department', 'role']);

            // Filter by department
            if ($request->has('department_id')) {
                $query->where('department_id', $request->department_id);
            }

            // Filter by role
            if ($request->has('role_id')) {
                $query->where('role_id', $request->role_id);
            }

            // Filter by status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Search by name or email
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'id');
            $sortOrder = $request->get('sort_order', 'asc');
            $query->orderBy($sortBy, $sortOrder);

            // Pagination
            $employees = $query->paginate($request->get('per_page', 15));

            return response()->json([
                'success' => true,
                'message' => 'Employees retrieved successfully',
                'data' => $employees
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employees',
                'error' => $e->getMessage()
            ], 500);
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
            $employee = Employee::create($validated);

            // Load relationships
            $employee->load(['department', 'role']);

            return response()->json([
                'success' => true,
                'message' => 'Employee created successfully',
                'data' => $employee
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create employee',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified employee
     */
    public function show($id)
    {
        try {
            $employee = Employee::with(['department', 'role'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Employee retrieved successfully',
                'data' => $employee
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => 'The requested employee does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employee',
                'error' => $e->getMessage()
            ], 500);
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

            // Load relationships
            $employee->load(['department', 'role']);

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully',
                'data' => $employee
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => 'The requested employee does not exist'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update employee',
                'error' => $e->getMessage()
            ], 500);
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

            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully',
                'data' => null
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => 'The requested employee does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete employee',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore a soft-deleted employee
     */
    public function restore($id)
    {
        try {
            $employee = Employee::withTrashed()->findOrFail($id);

            if (!$employee->trashed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee is not deleted'
                ], 400);
            }

            $employee->restore();

            return response()->json([
                'success' => true,
                'message' => 'Employee restored successfully',
                'data' => $employee
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => 'The requested employee does not exist'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore employee',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get employee statistics
     */
    public function statistics()
    {
        try {
            $stats = [
                'total' => Employee::count(),
                'active' => Employee::where('status', 'active')->count(),
                'inactive' => Employee::where('status', 'inactive')->count(),
                'on_leave' => Employee::where('status', 'on_leave')->count(),
                'deleted' => Employee::onlyTrashed()->count(),
                'avg_salary' => Employee::avg('salary'),
                'by_department' => Employee::select('department_id')
                    ->with('department')
                    ->groupBy('department_id')
                    ->selectRaw('department_id, count(*) as total')
                    ->get(),
                'by_role' => Employee::select('role_id')
                    ->with('role')
                    ->groupBy('role_id')
                    ->selectRaw('role_id, count(*) as total')
                    ->get()
            ];

            return response()->json([
                'success' => true,
                'message' => 'Statistics retrieved successfully',
                'data' => $stats
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
