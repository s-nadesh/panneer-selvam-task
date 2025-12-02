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
            <div class="card-body px-0">
               <div class="table-responsive">
                  <table id="user-list-table" class="table table-striped" role="grid" data-bs-toggle="data-table">
                     <thead>
                        <tr class="ligth">
                           <th>id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th style="min-width: 100px">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($users as $user)
                        <tr>
                           <td>{{ $user->id }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td class="border p-2">
                            <!-- <a href="{{ route('users.show', $user) }}" class="text-blue-600">View</a> -->
                            <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 ml-2">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-2"
                                        onclick="return confirm('Delete user?')">
                                    Delete
                                </button>
                            </form>
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
      </div>
        </div>
    </main>
@endsection