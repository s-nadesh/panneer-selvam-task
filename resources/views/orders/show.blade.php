@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
@include('layouts.sidebar')

<main class="main-content">
    <div class="position-relative iq-banner">
        @include('layouts.navbar')

        <div class="container-fluid content-inner mt-5 py-0">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg rounded-4 border-0">
                        
                        <div class="card-header bg-primary text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 text-white">Order Details</h4>
                            <a href="{{ route('order.index') }}" class="btn btn-light btn-sm fw-bold">
                                <- Back
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <p class="mb-1 fw-bold text-secondary">Order ID</p>
                                    <h6 class="fw-bold">{{ $orders->id }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1 fw-bold text-secondary">Order Date</p>
                                    <h6 class="fw-bold">{{ $orders->created_at->format('d M, Y') }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1 fw-bold text-secondary">Customer</p>
                                    <h6 class="fw-bold">{{ $orders->user->name ?? 'N/A' }}</h6>
                                </div>
                            </div>

                            <hr>

                            <h5 class="fw-bold mt-3 mb-3 text-primary">Order Items</h5>

                            <div class="table-responsive rounded">
                                <table class="table table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th width="25%">Description</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders->items as $index => $val)
                                        <tr class="text-center">
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $val->category->name }}</td>
                                            <td>{{ $val->product->name }}</td>
                                            <td class="text-start">{{ $val->product->description }}</td>
                                            <td>{{ $val->quantity }}</td>
                                            <td>₹{{ number_format($val->price,2) }}</td>
                                            <td class="fw-bold">₹{{ number_format($val->price * $val->quantity,2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 p-4 rounded-4 bg-light border">
                                <h5 class="fw-bold text-primary mb-3">Payment Summary</h5>

                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1 fw-semibold text-secondary">Total Amount</p>
                                        <h6 class="fw-bold">₹{{ number_format($orders->total_amount, 2) }}</h6>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1 fw-semibold text-secondary">Discount</p>
                                        <h6 class="fw-bold text-danger">₹{{ number_format($orders->discount, 2) }}</h6>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1 fw-semibold text-secondary">Final Price</p>
                                        <h4 class="fw-bold text-success">₹{{ number_format($orders->final_amount, 2) }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button class="btn btn-success px-4">
                                    <a href="{{route('order.invoice', $orders->id)}}" class="text-white">Download Invoice</a>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection
