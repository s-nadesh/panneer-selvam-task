<div class="d-flex gap-2 align-items-center list-user-action">
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('products.edit', $product) }}">
      Edit
   </a>
   <form action="{{ route('products.destroy', $product) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Delete product?')">
         Delete
      </button>
   </form>
</div>
