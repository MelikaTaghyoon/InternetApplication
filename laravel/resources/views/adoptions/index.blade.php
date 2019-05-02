@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-3" >
			@include('adoptions.filter')
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">Display all Adoptions</div>
				<!-- Display any errors-->
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
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Id</th>
								<th scope="col">User ID</th>
								<th scope="col">Animal ID</th>
								<th scope="col">Status</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($adoptions as $adoption)
							<tr>
								<th scope="row">{{$adoption['id']}}</th>
								<td>{{$adoption['userid']}}</td>
								<td>{{$adoption['animalid']}}</td>
								<td>{{$adoption['status']}}</td>
								<td><a href="{{action('AdoptionController@show',$adoption['id'])}}" class="btn btn-primary">Details</a></td>
								@if(auth()->user()->role === 1)
								<td>
									<form action="{{action('AdoptionController@destroy', $adoption['id'])}}" method="POST">@csrf
										<input type="hidden" name="_method" value="DELETE">
										<button class="btn btn-danger" type="submit">Delete</button>
									</form>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $adoptions->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection