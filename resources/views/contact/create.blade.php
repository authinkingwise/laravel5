@extends('layouts.back')

@section('title')
Create Contact
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Add a new contact<a href="{{ url('contacts') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All contacts</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('contacts') }}" method="POST">

				{{ csrf_field() }}

				<div class="form-group required{{ $errors->has('firstname') ? ' has-error' : '' }}">
					<label for="firstname" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-5">
						<input type="text" name="firstname" class="form-control" id="firstname" required="true" value="{{ old('firstname') ?: '' }}">

						@if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group">
					<label for="lastname" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-5">
						<input type="text" name="lastname" class="form-control" id="lastname" value="{{ old('lastname') ?: '' }}">
					</div>
				</div>

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-sm-2 control-label">Email Address</label>
					<div class="col-sm-5">
						<input type="text" name="email" class="form-control" id="email" value="{{ old('email') ?: '' }}">

						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group">
					<label for="mobile" class="col-sm-2 control-label">Mobile</label>
					<div class="col-sm-5">
						<input type="text" name="mobile" class="form-control" id="mobile" value="{{ old('mobile') ?: '' }}">
					</div>
				</div>

                <div class="form-group required">
                    <label for="account_id" class="col-sm-2 control-label">Account</label>
                    <div class="col-sm-5">
                        <select name="account_id" class="form-control" id="account_id" required="true">
                        	<option selected value> -- Select a Account -- </option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        <p class="help-block">If you can not find the account in the drop-down list, please <a href="{{ url('account/add') }}">create</a> a new account.</p>
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