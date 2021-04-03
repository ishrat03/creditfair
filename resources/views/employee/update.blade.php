@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h4>Update Employee</h4>
			</div>

			<div class="card-body">
				<a href="{{route('employee.index')}}" class="btn btn-primary btn-sm">List Employee</a>
				<hr>
				@if (count($errors) > 0)
					<ul class="alert alert-danger pl-5">
					  	@foreach($errors->all() as $error)
						 	<li>{{ $error }}</li> 
					  	@endforeach
					</ul>
				@endif
				<form action="{{route('employee.update', $employee['id'])}}" method="POST">
					@method('PATCH')
					@csrf
					<div class="form-group row">
						<label for="f_name" class="col-md-2 text-right">First Name</label>
						<div class="col-md-6">
							<input type="text" name="first_name" id="f_name" class="form-control" placeholder="First Name" required="" value="{{$employee['first_name']}}">
						</div>
					</div>

					<div class="form-group row">
						<label for="l_name" class="col-md-2 text-right">Last Name</label>
						<div class="col-md-6">
							<input type="text" name="last_name" id="l_name" class="form-control" placeholder="Last Name" required="" value="{{$employee['last_name']}}">
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-2 text-right">Email</label>
						<div class="col-md-6">
							<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{$employee['email']}}">
						</div>
					</div>

					<div class="form-group row">
						<label for="phone" class="col-md-2 text-right">Phone</label>
						<div class="col-md-6">
							<input type="text" id="phone" name="phone" class="form-control" placeholder="phone" value="{{$employee['phone']}}">
						</div>
					</div>

					<div class="form-group row">
						<label for="logo" class="col-md-2 text-right">Company</label>
						<div class="col-md-6">
							<select name="company_id" class="form-control" required>
								<option value="">Plese Select</option>
								@foreach($company as $value)
									<option value="{{$value['id']}}" {{($value['id'] == $employee['company_id']) ? 'selected': ''}}>{{$value['name']}}</option>}
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-3">
							
						</div>

						<div class="col-md-4">
							<button type="submit" class="btn btn-sm btn-block btn-primary">Update Employee</button>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
@endsection