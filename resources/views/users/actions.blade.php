<div class="d-flex gap-2 align-items-center list-user-action">
   @if(auth()->user()->can('users.edit'))
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('users.edit', $user) }}">
      Edit
   </a>
   @endif
   @if(auth()->user()->can('users.delete'))
   <form action="{{ route('users.destroy', $user) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Delete user?')">
         Delete
      </button>
   </form>
   @endif
</div>
