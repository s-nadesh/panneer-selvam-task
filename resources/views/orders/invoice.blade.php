<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Invoice</h2>
<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
<p><strong>Customer:</strong> {{ $order->user->name }}</p>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Product</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->items as $index => $item)
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $item->category->name }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->product->description }}</td>
        <td>{{ $item->quantity }}</td>
        <td>₹{{ number_format($item->price,2) }}</td>
        <td>₹{{ number_format($item->price * $item->quantity,2) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>

<h4 style="text-align:right; margin-top:20px;">
    Total: ₹{{ number_format($order->total_amount,2) }} <br>
    Discount: ₹{{ number_format($order->discount,2) }} <br>
    <strong>Final Amount: ₹{{ number_format($order->final_amount,2) }}</strong>
</h4>

</body>
</html>
