@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Employees</h5>
				</div>

				<div class="card-body">
					<a href="{{route('employee.create')}}" title="" class="btn btn-sm btn-primary">Add Employee</a>
					<hr>
					@if ($message = Session::get('success'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>{{ $message }}</strong>
						</div>
					@endif
					@if($employees->total() > 0)
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">SNo</th>
									<th class="text-center">Name</th>
									<th class="text-center">Phone</th>
									<th class="text-center">Email</th>
									<th class="text-center">Company</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($employees as $key => $value)
									<tr>
										<td class="text-center">{{$key + 1}}</td>
										<td class="text-center">{{$value->first_name.' '.$value->last_name}}</td>
										<td class="text-center">{{$value->phone}}</td>
										<td class="text-center">{{$value->email}}</td>
										<td class="text-center">{{$value->name}}</td>
										<td class="text-center">
											<form action="{{ route('employee.destroy',$value->id) }}" method="POST">
												<a class="btn btn-primary btn-sm" href="{{ route('employee.edit',$value->id) }}">Edit</a> | 
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm">Delete</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<hr>
						<div class="pagination justify-content-end">
							{{$employees->links()}}
						</div>
					@else
						<h3>No Data Found</h3>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
