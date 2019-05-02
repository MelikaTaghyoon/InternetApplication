@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Adoption number: {{$adoption['id']}}</div>

				<div class="card-body">
					<table class="table table-striped" border="1">
						<tr><th><b>Animal ID</b></th><td>{{$animal['id']}}</td></tr>
						<tr><th>Animal Type</th><td>{{$animal['type']}}</td></tr>
						<tr><th>Date of Birth</th><td>{{$animal['dob']}}</td></tr>
						<tr><th>Animal Status</th><td>{{$animal['status']}}</td></tr>
						<tr><th>Description</th><td style="max-width: 150px;">{{$animal['description']}}</td></tr>
						<tr><th>Status of Adoption</th><td>{{$adoption['status']}}</td></tr>
						<tr><th>Requester's name</th><td>{{$user['name']}}</td></tr>
						<tr><th>Requester's email</th><td>{{$user['email']}}</td></tr>
					</table>
					@if ($adoption['status']==='pending')
					<table>
						<tr>
							<td><a href="{{url('adoptions')}}" class="btn btn-primary" role="button">Back to the list</a></td>
							<td><a href="{{action('AdoptionController@accept', $adoption['id'])}}" class="btn btn-warning">Accept</a></td>
							<td><a href="{{action('AdoptionController@reject', $adoption['id'])}}" class="btn btn-warning">Reject</a></td>
							<td><form action="{{action('AdoptionController@destroy', $adoption['id'])}}" method="POST">@csrf
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>	
							</form></td>
						</tr>
					</table>
					@elseif ($adoption['status']==='accepted')
					<table>
						<tr>
							<td><a href="{{url('adoptions')}}" class="btn btn-primary" role="button">Back to the list</a></td>
							<td><form action="{{action('AdoptionController@destroy', $adoption['id'])}}" method="POST">@csrf
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>	
							</form></td>
						</tr>
					</table>
					@elseif ($adoption['status']==='rejected')
					<table>
						<tr>
							<td><a href="{{url('adoptions')}}" class="btn btn-primary" role="button">Back to the list</a></td>
							<td><a href="{{action('AdoptionController@reopen', $adoption['id'])}}" class="btn btn-warning">Re-open</a></td>
							<td><form action="{{action('AdoptionController@destroy', $adoption['id'])}}" method="POST">@csrf
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>	
							</form></td>
						</tr>
					</table>
					@else
					<table>
						<tr>
							<td><a href="{{url('adoptions')}}" class="btn btn-primary" role="button">Back to the list</a></td>
							<td><form action="{{action('AdoptionController@destroy', $adoption['id'])}}" method="POST">@csrf
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>	
							</form></td>
						</tr>
					</table>
					@endif

				</div>
			</div>
		</div>
	</div>
</div>
@endsection