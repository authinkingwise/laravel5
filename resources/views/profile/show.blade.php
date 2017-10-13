@extends('layouts.back')

@section('title')
Profile Details
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Profile</div>
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
									<dt>Username:</dt>
									<dd>{{ $user->name }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Email:</dt>
									<dd>{{ $user->email }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Full Name:</dt>
									<dd>
										@isset($user->full_name)
											{{ $user->full_name }}
										@endisset
									</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Created:</dt>
									<dd>{{ $user->created_at }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Role:</dt>
									<dd>
										@if($user->roles->first() != null)
											{{ $user->roles->first()->label }}
										@endif
									</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Avatar:</dt>
									<dd>
										<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-4">
												@isset($user->avatar)
													<img src="{{ asset('storage/profile') }}/{{ $user->tenant_id }}/{{ Auth::id() }}/{{ $user->avatar }}" class="img-circle m-t-xs img-responsive">
												@else
													No avatar image
												@endisset
											</div>
										</div>
									</dd>
								</dl>
						</div>

						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="pull-right">
								<a href="{{ url('profile/edit') }}" class="btn btn-skyblue btn-sm btn-block">
									<i class="fa fa-edit"></i>
									<span>Edit</span>
								</a>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>

@endsection