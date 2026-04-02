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
                                        <h4 class="card-title">Update Permissions</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('roles.update', $role) }}">
                                    @csrf @method('PUT')

                                    {{-- Role Name --}}
                                    <div class="form-group mb-3">
                                        <label>Role Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{$role->name}}" required>
                                    </div>

                                    <label>Assign Permissions</label>
                                    <div class="row">
                                        @foreach($permissions as $module => $perms)
                                        <div class="card m-3 p-3 col-3">

                                            <h6 class="fw-bold mb-3">{{ ucfirst($module) }}</h6>
                                            <label><input type="checkbox" class="select-all" data-module="{{ $module }}"> Select All</label>

                                            @foreach($perms as $perm)
                                                <div>
                                                <input 
                                                    type="checkbox" 
                                                    name="permissions[]" 
                                                    value="{{ $perm->name }}"
                                                    {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}>
                                                {{ str_replace($module.'.','', $perm->name) }}
                                                </div>
                                            @endforeach
                                        </div>
                                            
                                        @endforeach
                                    </div>
                                    <button class="btn btn-primary">Update Role Permissions</button>
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
