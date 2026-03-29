<div class="btn-group" role="group">
    <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-sm btn-info" title="View">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form method="POST" action="{{ route('employee.destroy', $employee->id) }}" style="display:inline;"
        onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
