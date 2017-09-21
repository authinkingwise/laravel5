@extends('layouts.back')

@section('title')
Users
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Users &nbsp;<span class="badge">{{ $total }}</span></div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('users/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add User</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-body">

					@isset($users)

						@if(count($users))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>User</th>
										<th>Email</th>
										<th>Role</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td>
												<div><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></div>
											</td>
											<td>
												<div>{{ $user->email }}</div>
											</td>
											<td>
												<div>
													@if($user->roles->first() != null)
														{{ $user->roles->first()->label }}
													@endif
												</div>
											</td>
											<td>
												<div>{{ $user->created_at }}</div>
											</td>
											<td class="actions">
												@can('edit-user')
												<a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
												@endcan

												@can('destroy-user')
												<form action="{{ url('users/'.$user->id) }}" method="POST" class="form-inline delete-action">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="DELETE">
													<div class="form-group">
														<button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
													</div>
												</form>
												@endcan

												@can('create-user')
													<!-- <a href="{{ url('users/'.$user->id.'/invite') }}" class="btn btn-default btn-sm"><i class="fa fa-mail-forward"></i><span class="hidden-xs">Invite</span></a> -->
													<form action="{{ url('users/'.$user->id.'/invite') }}" method="POST" class="form-inline delete-action invite-action">
														{{ csrf_field() }}
														<div class="form-group">
														<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-mail-forward"></i><span class="hidden-xs">Invite</span></button>
													</div>
													</form>
												@endcan
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>There is no user yet.</p>
						@endif

					@else
						<p>There is no user yet.</p>
					@endisset

				</div>

			</div>

		</div>

	</div><!-- End .row -->

	<div class="clearfix">
		<ul class="pull-right">
			{{ $users->render() }}
		</ul>
	</div>

@endsection