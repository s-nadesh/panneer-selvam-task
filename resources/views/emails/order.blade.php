@component('mail::message')
# Order Confirmation

Hi {{ $order->user->name }},

Your order **#{{ $order->id }}** has been successfully placed.

@component('mail::table')
| Product | Qty | Price |
|---------|-----|-------|
@foreach ($order->items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | {{ $item->product->price }} |
@endforeach
@endcomponent

**Total Amount:** ₹{{ $order->final_amount }}

Thanks for shopping with us!

@endcomponent
