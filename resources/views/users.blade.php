@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
    <a class="btn btn-success google-drive-opener1" href="{{route('add-user')}}">Add User</a>
  </div>


  <div class="card shadow mb-4">

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>IP Address</th>

              <th>State</th>
              <th>Country</th>
              <th>Browser</th>
              <th>OS Name</th>
              <th>Device Type</th>
            </tr>
          </thead>

          <tbody>
            @if($users)

            @foreach ($users as $user)
            <tr>
              <td>{{ucfirst($user->name)}}</td>
              <td>{{ucfirst($user->email)}}</td>
              <td>{{ucfirst($user->ip_address)}}</td>

              <td>{{ucfirst($user->state)}}</td>
              <td>{{ucfirst($user->country)}}</td>
              <td>{{ucfirst($user->browser_name)}}</td>
              <td>{{ucfirst($user->os_name)}}</td>
              <td>{{ucfirst($user->device_type)}}</td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="10">N0 Record Found!</td>
            </tr>
            @endif


          </tbody>
        </table>
      </div>
    </div>
  </div>




</div>
@endsection
@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush