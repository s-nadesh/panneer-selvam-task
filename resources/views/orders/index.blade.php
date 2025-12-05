@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
@include('layouts.sidebar')
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
         @include('layouts.navbar')  
         <div class="conatiner-fluid content-inner mt-5 py-0">
            <div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-header">
                           <div class=" d-flex justify-content-between align-items-center">
                              <h4 class="card-title">Order List</h4>
                              <a class="btn btn-primary" href="{{ url('placeorder') }}"> Add orders</a>
                           </div>
                        </div>
                        <div class="card-body px-5">
                           {{ $dataTable->table() }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </main>

@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush