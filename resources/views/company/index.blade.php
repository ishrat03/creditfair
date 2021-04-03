@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h4>Companies</h4>
			</div>

			<div class="card-body">
				<a href="{{route('company.create')}}" class="btn btn-primary btn-sm">Add New Company</a>
				<hr>
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
				@endif
				@if(!empty($company->total() > 0))
					<table class="table table-bordered">
						<!-- <caption>table title and/or explanatory text</caption> -->
						<thead>
							<tr>
								<th class="text-center">SNo.</th>
								<th class="text-center">Name</th>
								<th class="text-center">Email</th>
								<th class="text-center">Website</th>
								<th class="text-center">Logo</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($company as $key => $value)
								<tr>
									<td class="text-center">{{$key + 1}}</td>
									<td class="text-center">{{$value->name}}</td>
									<td class="text-center">{{$value->email}}</td>
									<td class="text-center">{{$value->website}}</td>
									<td class="text-center">
										<img src="{{asset('storage/'.$value->logo)}}" alt="Logo" width="50" width="50">
									</td>
									<td class="text-center">
										<form action="{{ route('company.destroy',$value->id) }}" method="POST">
											<a class="btn btn-primary btn-sm" href="{{ route('company.edit',$value->id) }}">Edit</a> | 
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
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-end">
							{{$company->links()}}
						</ul>
					</nav>
				@else
					<h2>No Data Found</h2>
				@endif
			</div>
		</div>

	</div>
@endsection