@extends('layouts.back')

@section('title')
Projects
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">All Projects</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<a href="{{ url('projects/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Project</span></a>
				</div>

			</div><!-- End .row -->

			<div class="row project-list">

				<div class="col-lg-12 col-md-12 col-sm-12">

					<div class="panel panel-default">

						<div class="panel-body">

							@if(count($projects))
								<table class="table table-hover">

									<thead>
										<tr>
											<th>Status</th>
											<th>Project</th>
											<th>Account</th>
											<th>Manager</th>
											<th>Visible</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										@foreach($projects as $project)

											<tr>
												<td class="status"><button class="btn btn-xs @if($project->status) btn-danger @else btn-default @endif">@if($project->status) Active @else Inactive @endif</button></td>
												<td class="name">
													<div><a href="{{ url('projects/'.$project->id) }}"><strong>{{ $project->name }}</strong></a></div>
													<div><small>{{ $project->created_at }}</small></div>
												</td>
												<td class="account"><a href="{{ url('accounts/'.$project->account->id) }}">{{ $project->account->name }}</a></td>
												<td class="user">{{ $project->user->name }}</td>
												<td class="visible">@if($project->visible) Yes @else No @endif</td>
												<td class="actions">
													@can('edit-project')
														<a href="{{ url('projects/'.$project->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
													@endcan
													@can('destroy-project')
														<form action="{{ url('projects/'.$project->id) }}" method="POST" class="form-inline delete-action">
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
								<p>There is no project yet.</p>
							@endif

						</div>

					</div>

				</div>

			</div><!-- End .row -->

		</div>

	</div><!-- End .content -->


@endsection