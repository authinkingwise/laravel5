@extends('layouts.back')

@section('title')
Edit Account
@endsection

@section('content')
	
	<div class="content">

		<div class="container-fluid add-account">

			<div class="panel panel-default">

				<div class="page-heading panel-heading">Edit account</div>
				
				<div class="panel-body">
					
					<form class="form-horizontal" action="{{ url('accounts/'.$account->id) }}" method="POST">
					
						{{ csrf_field() }}

						<input type="hidden" name="_method" value="PUT">

						<div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Company Name</label>
							<div class="col-sm-5">
								<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: (isset($account) ? $account->name : '') }}">

								@if ($errors->has('name'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('name') }}</strong>
		                            </span>
		                        @endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-5">
								<input type="text" name="email" class="form-control" id="email" value="{{ old('email') ?: (isset($account) ? $account->email : '') }}">
								
								@if ($errors->has('email'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('email') }}</strong>
		                            </span>
		                        @endif
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-5">
								<input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') ?: (isset($account) ? $account->phone : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-2 control-label">Website</label>
							<div class="col-sm-5">
								<input type="text" name="website" class="form-control" id="website" value="{{ old('website') ?: (isset($account) ? $account->website : '') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-5">
								<input type="text" name="address" class="form-control" id="address" value="{{ old('address') ?: (isset($account) ? $account->address : '') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-skyblue">Update</button>
							</div>
						</div>
					</form>
				</div>

			</div><!-- End .panel -->
		
		</div><!-- End .container -->

	</div><!-- End .content -->

@endsection