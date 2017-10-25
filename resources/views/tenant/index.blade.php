@extends('layouts.back')

@section('title')
Tenants
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">All Tenants</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<a href="{{ url('tenants') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Tenant</span></a>
				</div>

			</div><!-- End .row -->

			<div class="row tenant-list">

				<div class="col-lg-12 col-md-12 col-sm-12">

					<div class="panel panel-default">

						<div class="panel-body">

							@if(count($tenants))
								<table class="table table-hover">

									<thead>
										<tr>
											<th>Tenant</th>
											<th>Email</th>
											<th>Created at</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										@foreach($tenants as $tenant)

											<tr>
												<td class="name">
													<div><a href="{{ url('tenants/'.$tenant->id) }}"><strong>{{ $tenant->name }}</strong></a></div>
												</td>
												<td class="account">{{ $tenant->email }}</td>
												<td class="created_at">{{ $tenant->created_at }}</td>
												<td class="actions">
													@can('site-admin')
														<a href="{{ url('tenants/'.$tenant->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
													@endcan
													@can('site-admin')
														<form action="{{ url('tenants/'.$tenant->id) }}" method="POST" class="form-inline delete-action">
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="DELETE">
															<div class="form-group">
																<button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
															</div>
														</form>
													@endcan
												</td>
											</tr>

										@endforeach

									</tbody>

								</table>
							@else
								<p>There is no tenant yet.</p>
							@endif

						</div>

					</div>

				</div>

			</div><!-- End .row -->

		</div>

	</div><!-- End .content -->

@endsection