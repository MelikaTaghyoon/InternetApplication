@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="content">
		<div class="card-header">Access error</div>
		<div class="card-body">
			<div class="alert alert-danger">Access denied</div>
			<div class="alert alert-danger">You are trying to access this content without permission</div>
		</div>
		<a href="{{url('/')}}" class="btn btn-primary">Go to home</a>
</div>

@endsection