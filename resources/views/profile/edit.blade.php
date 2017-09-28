@extends('layouts.back')

@section('title')
Edit Profile
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Edit profile {{ $user->name }}&nbsp;<a href="{{ url('profile') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-user-circle"></i><span>Profile</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('profile') }}" method="POST">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<fieldset disabled>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">User Name</label>
						<div class="col-sm-5">
							<div class="form-control" id="name">{{ $user->name }}</div>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email Address</label>
						<div class="col-sm-5">
							<div class="form-control" id="email">{{ $user->email }}</div>
							<p class="help-block">No duplicate email is allowed to register in the system.</p>
						</div>
					</div>
				</fieldset>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-5">
						<input type="password" name="password" class="form-control" id="password" value="{{ old('password') ?: '' }}">

						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <p class="help-block">If leave the password empty, it will keep the old password.</p>
					</div>
				</div>

				<div class="form-group">
                    <label for="password-confirm" class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-5">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-skyblue">Update</button>
						<a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
					</div>
				</div>

			</form>

		</div>

	</div>

@endsection