@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
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
                           <div class="table-responsive">
                              <table id="user-list-table" class="table table-striped">
                                 <thead>
                                    <tr class="ligth">
                                          <th>ID</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Action</th>
                                    </tr>
                                 </thead>
                              </table>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </main>

@endsection

@push('script')

   <script>
      $(function() {
         $('#user-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.datatable') }}",
            columns: [
                  { data: 'id', name: 'id' },
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
         });
      });
   </script>
@endpush