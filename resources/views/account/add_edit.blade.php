@extends('layouts.back')

@section('title')
{{ isset($account) ? 'Edit Account' : 'Add an Account' }}
@endsection

@section('content')
	
	<div class="content">

		<div class="container-fluid add-account">

			<div class="panel panel-default">

				<div class="page-heading panel-heading">{{ isset($account) ? 'Edit account' : 'Add a new account' }}</div>
				
				<div class="panel-body">
					@isset($account)
						<form class="form-horizontal" action="{{ url('account/update', $account->id) }}" method="POST">
					@else
						<form class="form-horizontal" action="{{ url('account/store') }}" method="POST">
					@endif
						{{ csrf_field() }}
						<div class="form-group required">
							<label for="name" class="col-sm-2 control-label">Company Name</label>
							<div class="col-sm-5">
								<input type="text" name="Account[name]" class="form-control" id="name" required="true" value="{{ old('Account')['name'] ?: (isset($account) ? $account->name : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-5">
								<input type="text" name="Account[email]" class="form-control" id="email" value="{{ old('Account')['email'] ?: (isset($account) ? $account->email : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-5">
								<input type="text" name="Account[phone]" class="form-control" id="phone" value="{{ old('Account')['phone'] ?: (isset($account) ? $account->phone : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-2 control-label">Website</label>
							<div class="col-sm-5">
								<input type="text" name="Account[website]" class="form-control" id="website" value="{{ old('Account')['website'] ?: (isset($account) ? $account->website : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-5">
								<input type="text" name="Account[address]" class="form-control" id="address" value="{{ old('Account')['address'] ?: (isset($account) ? $account->address : '') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-skyblue">{{ isset($account) ? 'Update' : 'Add' }}</button>
							</div>
						</div>
					</form>
				</div>

			</div><!-- End .panel -->
		
		</div><!-- End .container -->

	</div><!-- End .content -->

@endsection