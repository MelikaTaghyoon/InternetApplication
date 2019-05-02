@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">{{$animal['name']}}</div>
				@if($errors->any())
				<div class="alert alert-danger">
					<ul>@foreach ($errors->all() as $error)
						<li>! {{$error}}</li> @endforeach
					</ul>
				</div><br />@endif

				<!---Display success-->
				@if(\Session::has('success'))
				<div class="alert alert-success">
					<p>{{\Session::get('success')}}</p>
				</div><br />@endif
				<div class="card-body">
					<table class="table table-striped" border="1">
						<tr><th><b>Animal ID</b></th><td>{{$animal['id']}}</td></tr>
						<tr><th>Title</th><td>{{$animal['title']}}</td></tr>
						<tr><th>Animal Type</th><td>{{$animal['type']}}</td></tr>
						<tr><th>Date of Birth</th><td>{{$animal['dob']}}</td></tr>
						<tr><th>Status</th><td>{{$animal['status']}}</td></tr>
						@if($animal['status']=="adopted")
						<tr><th>Adopted by</th><td>{{$adopter}}</td></tr>
						<tr><th>Adopter ID</th><td>{{$adopterid}}</td></tr>
						@endif
						<tr><th>Description</th><td style="max-width: 150px;">{{$animal['description']}}</td></tr>
						<tr><td colspan='2'><img style="width:100%;height:100%" src="{{asset('storage/images/'.$animal['image'])}}"></td></tr>
					</table>
					<table>
						<tr>
							<td><a href="{{url('animals')}}" role="button" class="btn btn-primary">Go back</a></td>
							<td><a href="{{action('AnimalController@edit', $animal['id'])}}" class="btn btn-warning">Edit</a></td>
							<td><form action="{{action('AnimalController@destroy', $animal['id'])}}" method="POST">@csrf
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>	
							</form></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection