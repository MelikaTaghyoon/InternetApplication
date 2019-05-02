<div class="card">
	<div class="card-header">Filter and search</div>
	<div class="card-body">
		<form class="form-horizontal" method="GET" action="{{action('AnimalController@index')}}" enctype="multipart/form-data">
			@csrf
			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<input type="text" name="name" placeholder="Search for names..">
			</div>

			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<label>Type:</label>
				<select name="type">
					<option value="*">All</option>
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

			<div class="col-md-10 sidebar-module" style="margin-bottom: 5px;">
				<input type="checkbox" name="sort" value="asc">
				<label>Sort by name</label>
			</div>


			<input type="submit" value="Filter" style="margin-bottom: 5px;" class="btn btn-primary"/>
		</form>
		<a href="/animals" style="margin-bottom: 5px;" class="btn btn-primary">Reset filters</a>
	</div>
</div>



