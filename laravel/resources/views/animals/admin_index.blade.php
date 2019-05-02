
<table class="table table-bordered">
	<thead class="thead-dark">
		<tr>
  			<th scope="col">Id</th>
  			<th scope="col">Name</th>
  			<th scope="col">Status</th>
  			<th scope="col">Type</th>
  			<th colspan="3">Action</th>
		</tr>
		</thead>
	@foreach ($animals as $animal)
	<tbody>
		<tr>
			<th scope="row">{{$animal['id']}}</th>
			<td>{{$animal['name']}}</td>
			<td>{{$animal['status']}}</td>
			<td><a href="{{action('AnimalController@show',$animal['id'])}}" class="btn btn-primary">Details</a></td>
			<td><a href="{{action('AnimalController@edit',$animal['id'])}}" class="btn btn-warning">Edit</a></td>
			<td>
				<form action="{{action('AnimalController@destroy', $animal['id'])}}" method="POST">@csrf
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-danger" type="submit">Delete</button>
				</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
{{ $animals->links() }}
