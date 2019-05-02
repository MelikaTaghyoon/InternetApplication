@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/animals.css') }}" rel="stylesheet">
@endpush
<!--define the content section  -->
@section('content')
<div class="container" style="max-width: 1340px;">
	<div class="row justify-content-centre">
		<div class="col-md-3" >
			@include('animals.filter')
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">Display all Animals
				</div>
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
					@guest
					@include('animals.public_index', ['animals'=>$animals])
					@else
					@if(auth()->user()->role == 1)
					@include('animals.admin_index',['animals'=>$animals])
					@else
					@include('animals.public_index',['animals'=>$animals])
					@endif
					@endguest
				</div>
			</div>
		</div>
	</div>
</div>
@endsection