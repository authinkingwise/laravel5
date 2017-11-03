@extends('layouts.back')

@section('title')
User Details
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">User Details</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('users') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Users</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="page-heading panel-heading">{{ $user->name }}</div>

				<div class="panel-body">

					<div class="row">
						<div class="col-lg-10 col-md-10 col-sm-10">
								<dl class="dl-horizontal">
									<dt>User:</dt>
									<dd>{{ $user->name }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Email:</dt>
									<dd>{{ $user->email }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Created:</dt>
									<dd>{{ $user->created_at }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Last Updated:</dt>
									<dd>{{ $user->updated_at }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Role:</dt>
									<dd>
										@if($user->roles->first() != null)
											{{ $user->roles->first()->label }}
										@endif
									</dd>
								</dl>
						</div>

						@can('edit-user')
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="pull-right">
								<a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-skyblue btn-sm btn-block">
									<i class="fa fa-edit"></i>
									<span>Edit</span>
								</a>
							</div>
						</div>
						@endcan
					</div>

				</div>

			</div>

		</div>

	</div>

	@include('user.tab')

@endsection