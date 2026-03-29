<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('department_name', function ($employee) {
                return $employee->department ? $employee->department->name : '-';
            })
            ->addColumn('role_name', function ($employee) {
                return $employee->role ? $employee->role->name : '-';
            })
            ->addColumn('status_badge', function ($employee) {
                $statusMap = [
                    'active' => '<span class="badge bg-success">Active</span>',
                    'inactive' => '<span class="badge bg-secondary">Inactive</span>',
                    'on_leave' => '<span class="badge bg-warning">On Leave</span>',
                ];
                return $statusMap[$employee->status] ?? '<span class="badge bg-light">Unknown</span>';
            })
            ->addColumn('salary_formatted', function ($employee) {
                return 'Rp' . number_format($employee->salary ?? 0, 0, ',', '.');
            })
            ->addColumn('action', function ($employee) {
                return view('employee.partials.actions', compact('employee'))->render();
            })
            ->rawColumns(['status_badge', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query object to be processed by dataTables.
     */
    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['department', 'role']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1, 'asc')
            ->pageLength(10)
            ->responsive(true)
            ->autoWidth(false)
            ->lengthMenu([[10, 25, 50, 100], ['10', '25', '50', '100']])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(50)
                ->visible(false),
            Column::make('full_name')
                ->title('Name'),
            Column::make('email')
                ->title('Email'),
            Column::make('phone')
                ->title('Phone'),
            Column::make('department_name')
                ->title('Department')
                ->data('department_name')
                ->orderable(false)
                ->searchable(false),
            Column::make('role_name')
                ->title('Role')
                ->data('role_name')
                ->orderable(false)
                ->searchable(false),
            Column::make('status_badge')
                ->title('Status')
                ->data('status_badge')
                ->orderable(false)
                ->searchable(false),
            Column::make('salary_formatted')
                ->title('Salary')
                ->data('salary_formatted')
                ->orderable(false)
                ->searchable(false),
            Column::computed('action')
                ->title('Actions')
                ->data('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Employees_' . date('YmdHis');
    }
}
