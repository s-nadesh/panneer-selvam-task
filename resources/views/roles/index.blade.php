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
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title">User List</h4>
                           </div>
                        </div>
                        <div class="card-body px-5">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">
                                Add New Role
                            </a>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>

                                            <td>
                                                @can('roles.edit')
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                @endcan

                                                @can('roles.delete')
                                                <form action="{{ route('roles.destroy', $role->id) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @csrf @method('DELETE')

                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Delete this role?')">
                                                        Delete
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </main>

@endsection
