@extends('layouts.back')

@section('title')
Settings
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">Settings</div>
				</div>

			</div><!-- End .row -->

			<div class="row">

				<div class="sideTabs col-lg-3 col-md-3">
					
					<div class="panel panel-default">

						<ul class="nav nav-pills nav-stacked" role="tablist">

							<div class="panel-nav-heading">
								<strong>General</strong>
							</div>

							<li class="item active">
								<a href="#account-settings" aria-controls="account-settings" role="tab" data-toggle="tab">Account Settings</a>
							</li>
							<li class="item">
								<a href="#notifications" aria-controls="" role="tab" data-toggle="tab">Notifications</a>
							</li>

							<div class="panel-nav-heading">
								<strong>Plans and Billing</strong>
							</div>

							<li class="item">
								<a href="#plan-details" aria-controls="" role="tab" data-toggle="tab">Plan details</a>
							</li>

							<li class="item">
								<a href="#users-on-plan" aria-controls="" role="tab" data-toggle="tab">Users on plan</a>
							</li>

							<li class="item">
								<a href="#billing-address" aria-controls="" role="tab" data-toggle="tab">Billing address</a>
							</li>

						</ul>

					</div>

				</div>

				<div id="access_form" class="defaultForm col-lg-9 col-md-9">

					<div class="panel panel-default">

						<div class="panel-body">

							<!-- Tab panes -->
						  	<div class="tab-content">

						  		<div role="tabpanel" class="tab-pane active" id="account-settings">
						  			
						  			<div class="panel-heading page-heading">
						  				Account Settings
						  			</div>

						  			<form class="form-horizontal" action="{{ url('settings/account') }}" method="POST">

						  				{{ csrf_field() }}

						  				<div class="form-group required{{ $errors->has('company-name') ? ' has-error' : '' }}">
						  					<label for="name" class="col-md-3 control-label">Company Name</label>
						  					<div class="col-md-5">
												<input type="text" name="company-name" class="form-control" id="company-name" required="true" value="{{ old('company-name') ?: (isset($tenant->name) ? $tenant->name : '') }}">

												@if ($errors->has('company-name'))
						                            <span class="help-block">
						                                <strong>{{ $errors->first('company-name') }}</strong>
						                            </span>
						                        @endif
											</div>
						  				</div>

						  				<div class="form-group">
						  					<label class="col-md-3 control-label">Email Address</label>
						  					<div class="col-md-5">
						  						<div class="form-control-static">{{ $tenant->email }}</div>
						  					</div>
						  				</div>

						  				<div class="form-group">
						  					<label for="website" class="col-md-3 control-label">Website</label>
						  					<div class="col-md-5">
												<input type="text" name="website" class="form-control" id="website" required="true" value="{{ old('website') ?: '' }}">
											</div>
						  				</div>

						  				<div class="form-group">
											<div class="col-md-offset-9 col-md-3">
												<button type="submit" class="btn btn-skyblue">Save</button>
											</div>
										</div>

						  			</form>

						  		</div>

						  		<div role="tabpanel" class="tab-pane" id="notifications">
						  			<div class="panel-heading page-heading">
						  				Notifications
						  			</div>

						  			<form class="form-horizontal" action="{{ url('settings/notifications') }}" method="POST">

						  				{{ csrf_field() }}

						  				<div class="form-group">
						  					<label class="col-md-3 control-label">
						  						<strong>Email Notifications to Users</strong>
						  					</label>
						  					<div class="col-md-9">
						  						<div class="checkbox">
						  							<label for="ticket-notification">
							  							<input type="checkbox" name="ticket-notification" id="ticket-notification">
							  							<span class="ck"><i class="fa fa-check ck-icon" aria-hidden="true"></i></span>
							  							Notifies the user when his/her ticket is updated.
							  						</label>
						  						</div>
						  						<div class="checkbox">
							  						<label for="project-notification">
							  							<input type="checkbox" name="project-notification" id="project-notification">
							  							<span class="ck"><i class="fa fa-check ck-icon" aria-hidden="true"></i></span>
							  							Notifies the user when his/her project or task is updated.
							  						</label>
						  						</div>
						  						<div class="checkbox">
							  						<label for="role-notification">
							  							<input type="checkbox" name="role-notification" id="role-notification">
							  							<span class="ck"><i class="fa fa-check ck-icon" aria-hidden="true"></i></span>
							  							Notifies the user when his/her role (permission) is updated.
							  						</label>
						  						</div>
						  					</div>
						  				</div>

						  				<div class="form-group">
						  					<label class="col-md-3 control-label">
						  						<strong>Email me about</strong>
						  					</label>
						  					<div class="col-md-9">
						  						<div class="checkbox">
						  							<label for="update-notification">
							  							<input type="checkbox" name="update-notification" id="update-notification">
							  							<span class="ck"><i class="fa fa-check ck-icon" aria-hidden="true"></i></span>
							  							Occasional updates from us.
							  						</label>
						  						</div>
						  					</div>
						  				</div>

						  				<div class="form-group">
											<div class="col-md-offset-9 col-md-3">
												<button type="submit" class="btn btn-skyblue">Save</button>
											</div>
										</div>

						  			</form>
						  		</div>

						  		<div role="tabpanel" class="tab-pane" id="plan-details">
						  			<div class="panel-heading page-heading">
						  				Plan details
						  			</div>

						  			<div class="panel-body">
						  				<div class="row current-plan">
								  			<div class="col-md-9">
								  				<div class="darkblue">You're on the Free plan.</div>
								  			</div>
								  			<div class="col-md-3">
								  				<a href="#" class="btn btn-primary btn-default pull-right">Upgrade Plan</a>
								  			</div>
							  			</div>
							  			
							  			<div class="row usage-summary">
								  			<div class="col-md-12">
								  				<div class="section-heading">Usage summary</div>

								  				<p><span class="darkblue"><strong>2 users</strong></span> on your plan.</p>

								  				<div class="row">
								  					<div class="col-md-9">
								  						<div class="darkblue"><strong>Total based on current usage</strong></div>
								  						<div>Billing period: Oct 1, 2017 - Nov 1, 2017</div>
								  					</div>
								  					<div class="col-md-3">
								  						<span class="pull-right darkblue"><strong>$0</strong></span>
								  					</div>
								  				</div>
								  			</div>
								  		</div>
						  			</div>
						  		</div>

						  		<div role="tabpanel" class="tab-pane" id="users-on-plan">
						  			<div class="panel-heading page-heading">
						  				Users on plan
						  			</div>

						  			<form class="form-horizontal" action="{{ url('settings/users-on-plan') }}" method="POST">
						  				{{ csrf_field() }}

						  			</form>
						  		</div>

						  		<div role="tabpanel" class="tab-pane" id="billing-address">
						  			<div class="panel-heading page-heading">
						  				Billing Address
						  			</div>

						  			<div class="panel-body">

									  	<div class="section-heading">Enter your billing details</div>

									  	<form class="form-horizontal margin-top" action="{{ url('settings/billing-address') }}" method="POST">
									  		{{ csrf_field() }}
									  		<div class="form-group">
									  			<label for="company-name-billing" class="col-md-3 control-label">Company Name</label>
									  			<div class="col-md-9">
													<input type="text" name="company-name" class="form-control" id="company-name-billing" required="true" value="{{ old('company-name') ?: (isset($tenant->name) ? $tenant->name : '') }}">
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label for="company-address" class="col-md-3 control-label">Address</label>
									  			<div class="col-md-9">
													<input type="text" name="company-address" class="form-control" id="company-address" required="true" value="{{ old('company-address') ?: '' }}">
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label for="city" class="col-md-3 control-label">City</label>
									  			<div class="col-md-5">
													<input type="text" name="city" class="form-control" id="city" required="true" value="{{ old('city') ?: '' }}">
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label for="state" class="col-md-3 control-label">State / Province</label>
									  			<div class="col-md-5">
													<input type="text" name="state" class="form-control" id="state" required="true" value="{{ old('state') ?: '' }}">
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label for="postcode" class="col-md-3 control-label">Postcode / Zip</label>
									  			<div class="col-md-5">
													<input type="text" name="postcode" class="form-control" id="postcode" required="true" value="{{ old('postcode') ?: '' }}">
												</div>
									  		</div>
									  		<div class="form-group">
									  			<label for="country" class="col-md-3 control-label">Country</label>
									  			<div class="col-md-5">
													<input type="text" name="country" class="form-control" id="country" required="true" value="{{ old('country') ?: '' }}">
												</div>
									  		</div>
									  		<div class="form-group">
												<div class="col-md-offset-9 col-md-3">
													<button type="submit" class="btn btn-skyblue pull-right">Save</button>
												</div>
											</div>
									  	</form>
									</div>
						  		</div>

						  	</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

@endsection