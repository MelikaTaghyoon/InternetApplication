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
					<div class="row">
						<div class="col-md-4"><img style="width:100%;height:100%;object-fit: contain;" src="{{asset('storage/images/'.$animal['image'])}}"></div>
						<div class="col-md-8">
							<table class="table table-striped" border="1">
								<tr><th><b>Animal ID</b></th><td>{{$animal['id']}}</td></tr>
								<tr><th>Title</th><td>{{$animal['title']}}</td></tr>
								<tr><th>Animal Type</th><td>{{$animal['type']}}</td></tr>
								<tr><th>Date of Birth</th><td>{{$animal['dob']}}</td></tr>
								<tr><th>Status</th><td>{{$animal['status']}}</td></tr>
								<tr><th>Description</th><td style="max-width: 150px;">{{$animal['description']}}</td></tr>
								@guest
								<tr><td><a href="{{url('login')}}">Login to adopt this pet</label></td></tr>
									@else
									@if($adoptionExist)
									<tr><td><a href="{{action('AdoptionController@show', $adoption['id'])}}" class="btn btn-primary" >View your request</a></td></tr>
									@else
									<tr><td><form method="POST" action="{{action('AdoptionController@store')}}" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="animalid" value="{{$animal['id']}}">
										<input type="submit" value="Request to adopt" class="btn btn-primary"/>
									</form></td></tr>
									@endif
									@endguest
									<tr><td><a href="{{url('animals')}}" class="btn btn-primary">Go back</a></td></tr>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	@endsection

