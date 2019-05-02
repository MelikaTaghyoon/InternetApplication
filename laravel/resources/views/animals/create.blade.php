@extends('layouts.app')

<!--define the content section  -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Create an new animal</div>
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

				<!--Form section for data entry-->
				<div class="card-body">
					<form class="form-horizontal" method="POST" action="{{url('animals')}}" enctype="multipart/form-data">
						@csrf
						<div class="col-md-8">
							<label>Animal Name</label>
							<input type="text" required name="name" placeholder="Animal name..."/>
						</div>
						<div class="col-md-8">
							<label>Title</label>
							<input type="text" required name="title" placeholder="Animal title..."/>
						</div>
						<div class="col-md-8">
							<label>Animal's Date of Birth</label>
							<input type="date" required name="dob"/>
						</div>
						<div class="col-md-8">
							<label>Description</label>
							<textarea name="description" placeholder="Description of Animal.." rows="5" cols="30"></textarea> 
						</div>

						<div class="col-md-8">
							<label>Type</label>
							<select required name="type">
								<option value="birds">Birds</option>
								<option value="cats">Cats</option>
								<option value="dogs">Dogs</option>
								<option value="fish">Fish</option>
								<option value="horses">Horses</option>
								<option value="invertebrates">Invertebrates</option>
								<option value="poultry">Poultry</option>
								<option value="rabbits">Rabbits</option>
								<option value="reptiles">Reptiles</option>
								<option value="rodents">Rodents</option>
								<option value="others">Others</option>
							</select>
						</div>
						<div class="col-md-8">
							<label>Image</label>
							<input type="file" name="image" placeholder="Image file"/>
						</div>
						<div class="col-md-6 col-md-offset-4">
							<input type="submit" class="btn btn-primary"/>
							<input type="reset" class="btn btn-primary"/>
							<a href="{{url('animals')}}" class="btn btn-primary">Go back</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection