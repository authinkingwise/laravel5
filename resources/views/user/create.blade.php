@extends('layouts.back')

@section('title')
Create User
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Add a new user<a href="{{ url('users') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Users</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('users') }}" method="POST">

				{{ csrf_field() }}

				<div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-sm-2 control-label">User Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: '' }}">

						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-sm-2 control-label">Email Address</label>
					<div class="col-sm-5">
						<input type="text" name="email" class="form-control" id="email" required="true" value="{{ old('email') ?: '' }}">

						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group required{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-5">
						<input type="password" name="password" class="form-control" id="password" required="true" value="{{ old('password') ?: '' }}">

						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group required">
                    <label for="password-confirm" class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-5">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group required">
                    <label for="role_id" class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-5">
                        <select name="role_id" class="form-control" id="role_id">
                        	<option selected value> -- Select a Role -- </option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @can('create-role')
                        	<p class="help-block">If you can not find the role in the drop-down list, please <a href="{{ url('roles/create') }}">create</a> a new role.</p>
                        @endcan
                    </div>
                </div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-skyblue">Add</button>
					</div>
				</div>

			</form>

		</div>

	</div>

@endsection