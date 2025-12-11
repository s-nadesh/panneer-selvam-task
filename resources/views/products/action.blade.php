<div class="d-flex gap-2 align-items-center list-user-action">
   @if(auth()->user()->can('products.edit'))
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('products.edit', $product) }}">
      Edit
   </a>
   @endif
   @if(auth()->user()->can('products.delete'))
   <form action="{{ route('products.destroy', $product) }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Delete product?')">
         Delete
      </button>
   </form>
   @endif
</div>
