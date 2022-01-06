@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">USPS Price List</h1>
        
    </div>
    
          
            <div class="card shadow mb-4">
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>lbs</th>
                                    <th>Price</th>
                                    <th>Update Date</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if($uspsprice_list)
                               
                                    @foreach ($uspsprice_list as $list)
                                        <tr>
                                            <td>{{$list->lbs}} lbs</td>
                                            <td>${{$list->price}}</td>
                                            <td>{{$list->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">N0 Record Found!</td>
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