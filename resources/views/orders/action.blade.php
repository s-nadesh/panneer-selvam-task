<div class="d-flex gap-2 align-items-center list-user-action">
   @if(auth()->user()->can('orders.view'))
   <a class="btn btn-sm btn-icon btn-warning" href="{{ url('ordersshow/'.$order->id) }}">
      view
   </a>
   @endif
   @if(auth()->user()->can('orders.edit'))
   <a class="btn btn-sm btn-icon btn-warning" href="{{ route('order.edit', $order->id) }}">
      Edit
   </a>
   @endif
</div>
