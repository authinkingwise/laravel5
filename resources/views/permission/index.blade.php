@extends('layouts.back')

@section('title')
Permissions
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Application Permissions &nbsp;<span class="badge">{{ $total }}</span></div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('permissions/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Permission</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-body">

					@isset($permissions)

						@if(count($permissions))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Permission</th>
										<th class="hidden-xs">Label</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $permission)
										<tr>
											<td>
												<div><strong>{{ $permission->name }}</strong></div>
											</td>
											<td class="hidden-xs">
												<div>{{ $permission->label }}</div>
											</td>
											<td class="actions">
												<a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
													
												<form action="{{ url('permissions/'.$permission->id) }}" method="POST" class="form-inline delete-action">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="DELETE">
													<div class="form-group">
														<button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')"><i class="fa fa-trash"></i><span class="hidden-xs">Remove</span></button>
													</div>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>There is no permission yet.</p>
						@endif

					@else
						<p>There is no permission yet.</p>
					@endisset

				</div>

			</div>

		</div>

	</div><!-- End .row -->

	<div class="clearfix">
		<ul class="pull-right">
			{{ $permissions->render() }}
		</ul>
	</div>

@endsection