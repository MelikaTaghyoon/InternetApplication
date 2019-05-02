@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Adoption number: {{$adoption['id']}}</div>

				<div class="card-body">
					@if($adoption['status']=='accepted')
					<div class="alert alert-success">Congratulation your adoption request has been accepted</div>
					@elseif($adoption['status']=='rejected')
					<div class="alert alert-danger">Unfortunately, your adoption request has been rejected</div>
					@else
					<div class="alert alert-info">Your application is still under consideration, we will try to get back to you as soon as possible.</div>
					@endif

					<table class="table table-striped" border="1">
						<tr><th><b>Animal ID</b></th><td>{{$animal['id']}}</td></tr>
						<tr><th>Status of Adoption</th><td>{{$adoption['status']}}</td></tr>
						<tr><th>Animal Type</th><td>{{$animal['type']}}</td></tr>
						<tr><th>Title</th><td>{{$animal['title']}}</td></tr>
						<tr><th>Date of Birth</th><td>{{$animal['dob']}}</td></tr>
						<tr><th>Animal Status</th><td>{{$animal['status']}}</td></tr>
						<tr><th>Description</th><td style="max-width: 150px;">{{$animal['description']}}</td></tr>
						<tr><td><a href="{{url('adoptions')}}" class="btn btn-primary">Back to the list</a></td></tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection