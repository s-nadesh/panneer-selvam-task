<div class="d-flex gap-2 align-items-center list-user-action">
   <a class="btn btn-sm btn-icon btn-warning" href="{{ url('ordersshow/'.$order->id) }}">
      view
   </a>
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('order.edit', $order->id) }}">
      Edit
   </a>
</div>
