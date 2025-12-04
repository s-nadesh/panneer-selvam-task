<div class="d-flex gap-2 align-items-center list-user-action">
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('categorys.edit', $category) }}">
      Edit
   </a>
   <form action="{{ route('categorys.destroy', $category) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Delete category?')">
         Delete
      </button>
   </form>
</div>
