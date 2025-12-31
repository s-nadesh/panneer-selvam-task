<div>
    @can('roles.edit')
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
    @endcan

    @can('roles.delete')
    <form action="{{ route('roles.destroy', $role->id) }}"
        method="POST"
        class="d-inline">
        @csrf @method('DELETE')

        <button class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this role?')">
            Delete
        </button>
    </form>
    @endcan
</div>