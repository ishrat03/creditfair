@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h4>Add New Company</h4>
			</div>

			<div class="card-body">
				<a href="{{route('company.index')}}" class="btn btn-primary btn-sm">List Company</a>
				<hr>
				@if (count($errors) > 0)
					<ul class="alert alert-danger pl-5">
					  	@foreach($errors->all() as $error)
						 	<li>{{ $error }}</li> 
					  	@endforeach
					</ul>
				@endif
				<form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<label for="name" class="col-md-2 text-right">Company Name</label>
						<div class="col-md-6">
							<input type="text" name="name" id="name" class="form-control" placeholder="Company Name" required="">
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-2 text-right">Company Email</label>
						<div class="col-md-6">
							<input type="email" id="email" name="email" class="form-control" placeholder="Company Email">
						</div>
					</div>

					<div class="form-group row">
						<label for="website" class="col-md-2 text-right">Company Website</label>
						<div class="col-md-6">
							<input type="text" id="website" name="website" class="form-control" placeholder="Company Website">
						</div>
					</div>

					<div class="form-group row">
						<label for="logo" class="col-md-2 text-right">Company Logo</label>
						<div class="col-md-6">
							<input type="file" id="logo" name="logo" class="form-control">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-3">
							
						</div>

						<div class="col-md-4">
							<button type="submit" class="btn btn-sm btn-block btn-primary">Add Company</button>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
@endsection