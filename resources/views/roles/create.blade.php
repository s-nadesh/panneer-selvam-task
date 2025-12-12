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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Add New product</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('roles.store') }}" method="POST">
                                        @csrf

                                        {{-- Role Name --}}
                                        <div class="form-group mb-3">
                                            <label>Role Name *</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>

                                        <div class="row">
                                            <label>Assign Permissions</label>
                                            @foreach($permissions as $module => $perms)
                                            
                                                <div class="card m-3 p-3 col-3">
                                                    <h6 class="fw-bold mb-3">{{ ucfirst($module) }}</h6>
                                                    <label><input type="checkbox" class="select-all" data-module="{{ $module }}"> Select All</label>

                                                    @foreach($perms as $perm)
                                                        <div>
                                                        <input 
                                                            type="checkbox" 
                                                            name="permissions[]" 
                                                            value="{{ $perm->name }}">
                                                        {{ str_replace($module.'.','', $perm->name) }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create Role</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </main>
@endsection