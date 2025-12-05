@extends('layouts.app')

@section('title', 'orders')

@section('content')
@include('layouts.sidebar')
    <main class="main-content">
        <div class="position-relative iq-banner">
            @include('layouts.navbar')

            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title"> orders</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="max-w-xl mx-auto mt-6">
                                        <h2 class="text-2xl font-bold mb-4">Order Details</h2>

                                        <p><strong>Name:</strong> {{ $orders[0]->id }}</p>
                                        <p class="mt-2"><strong>Email:</strong> {{ $orders[0]->id }}</p>

                                        <a href="{{ route('order.index') }}" 
                                        class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </main>
@endsection