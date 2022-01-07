@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Profile</h1>
		<script src="https://gumroad.com/js/gumroad.js"></script>
	</div>

@include('components.message')
	<div class="row justify-content-between">
		<div class="col-md-12 mb-2" style="float: left">
			<div class="card shadow mb-4">
        <div class="card-body">
        	<h2>Update Information</h2>
        	<form method="POST" action="{{route('update-profile')}}">
        		@csrf
        		<div class="form-group">
        			<label class="form-label">Name</label>
        			<input type="text" name="profile_name" class="form-control" value="{{\Auth::user()->name}}">
        		</div>
        		<h4>Change Password</h4>
        		<div class="form-group">
        			<label class="form-label">New Password</label>
        			<input type="password" name="password" class="form-control" >
        		</div>
        		<div class="form-group">
        			<label class="form-label">Confirm Password</label>
        			<input type="password" name="password_confirmation" class="form-control" >
        		</div>
        		<div class="form-group">
        			<button type="submit" class="btn btn-primary">
        				Save
        			</button>
        		</div>
        	</form>
        </div>
      </div>
		</div>
	</div>
</div>

@endsection