@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">IP Address Hits		
        </h1>
        
    </div>
    <div class="row">
       
        <div class="col-md-12">
          
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>City</th>
                                    <th>Zip Code</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Browser</th>
                                    <th>OS Name</th>
                                    <th>Device Type</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               @if($login_history)
                               
                                    @foreach ($login_history as $history)
                                        <tr>
                                            <td>{{ucfirst($history->ip_address)}}</td>
                                            <td>{{ucfirst($history->city)}}</td>
                                            <td>{{ucfirst($history->zip_code)}}</td>
                                            <td>{{ucfirst($history->state)}}</td>
                                            <td>{{ucfirst($history->country)}}</td>
                                            <td>{{ucfirst($history->browser_name)}}</td>
                                            <td>{{ucfirst($history->os_name)}}</td>
                                            <td>{{ucfirst($history->device_type)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        
                                        <td colspan="8">N0 Record Found!</td>
                                    </tr>
                                @endif
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
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
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
    
  </script>
@endpush