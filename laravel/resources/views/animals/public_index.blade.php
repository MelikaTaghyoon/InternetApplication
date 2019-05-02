<div class="row justify-content-centre">
	@foreach ($animals as $animal)
	<div class="col-4">
		<div class="card " style="width:18rem; height:26rem; margin: 10px;">
			<img class="card-img-top" style="width: 250px; height:250px;object-fit: cover;" src="{{asset('storage/images/'.$animal['image'])}}" alt="animal image">
			<div class="card-body" >
				<h5 class="card-title">{{$animal['name']}}</h5>
				<p class="card-text">{{$animal['title']}}</p>
				<a href="{{action('AnimalController@show',$animal['id'])}}" class="btn btn-primary">Find out more</a>
			</div>
		</div>
	</div>
	@endforeach
</div>
{{ $animals->links() }}