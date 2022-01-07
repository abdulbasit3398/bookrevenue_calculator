@if(\Session::has('message'))
  <div class="alert alert-success alert-dismissible fade show">
    {!! \Session::get('message') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(\Session::has('error'))
  <div class="alert alert-danger alert-dismissible fade show">
    {!! \Session::get('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif
<br/>