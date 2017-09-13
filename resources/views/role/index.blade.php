@extends('layouts.back')

@section('title')
Roles
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Roles &nbsp;<span class="badge">{{ $total }}</span></div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('roles/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Role</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-body">

					@if(count($roles))
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Role</th>
									<th class="hidden-xs">Label</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $role)
									<tr>
										<td><strong>{{ $role->name }}</strong></td>
										<td>{{ $role->label }}</td>
										<td class="actions">
											@can('edit-role', Auth::user()->roles->first())
												<a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
											@endcan

											@if($role->name != 'admin')
												@can('destroy-role', Auth::user())
												<form action="{{ url('roles/'.$role->id) }}" method="POST" class="form-inline delete-action">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="DELETE">
													<div class="form-group">
														<button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
													</div>
												</form>
												@endcan
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>There is no role yet.</p>
					@endif

				</div>

			</div>

		</div>

	</div>

@endsection