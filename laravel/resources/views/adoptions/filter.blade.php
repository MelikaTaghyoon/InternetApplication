<div class="card">
	<div class="card-header">Filter and search</div>
	<div class="card-body">
		<form class="form-horizontal" method="GET" action="{{action('AdoptionController@index')}}" enctype="multipart/form-data">
			@csrf
			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<input type="text" name="id" placeholder="Search for Adoption id..">
			</div>

			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<input type="text" name="animalid" placeholder="Search for animal Id..">
			</div>
			@if(auth()->user()->role==1)
			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<input type="text" name="userid" placeholder="Search for user Id..">
			</div>
			@endif
			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<label>Status:</label>
				<select name="status">
					<option value="*">All</option>
					<option value="pending">Pending</option>
					<option value="accepted">Accepted</option>
					<option value="rejected">Rejected</option>
				</select>
			</div>

			<input type="submit" value="Filter" style="margin-bottom: 5px;" class="btn btn-primary"/>
		</form>
		<a href="/adoptions" style="margin-bottom: 5px;" class="btn btn-primary">Reset filters</a>
	</div>
</div>
