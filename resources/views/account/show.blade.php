@extends('layouts.back')

@section('title')
Account Details
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Account Details</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('accounts') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Accounts</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="page-heading panel-heading">{{ $account->name }}</div>

				<div class="panel-body">

					<div class="row">
						<div class="col-lg-10 col-md-10 col-sm-10">
								<dl class="dl-horizontal">
									<dt>Name:</dt>
									<dd>{{ $account->name }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Email:</dt>
									<dd>{{ $account->email }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Phone:</dt>
									<dd>{{ $account->phone }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Website:</dt>
									<dd>
										@isset($account->website)
											<a href="{{ $account->website }}" target="_blank">{{ $account->website }}</a>
										@endisset
									</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Address:</dt>
									<dd>{{ $account->address }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Created:</dt>
									<dd>{{ $account->created_at }}</dd>
								</dl>

								@isset($account->user)
									<dl class="dl-horizontal">
										<dt>Created by User:</dt>
										<dd>{{ $account->user->name }}</dd>
									</dl>
								@endisset

								<dl class="dl-horizontal">
									<dt>Last Updated:</dt>
									<dd>{{ $account->updated_at }}</dd>
								</dl>
						</div>

						@can('edit-account')
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="pull-right">
								<a href="{{ url('accounts/' . $account->id . '/edit') }}" class="btn btn-skyblue btn-sm btn-block">
									<i class="fa fa-edit"></i>
									<span>Edit</span>
								</a>
							</div>
						</div>
						@endcan
					</div>

				</div><!-- End .panel-body -->

			</div><!-- End .panel-default -->

			<div class="panel panel-default">

				<div class="page-heading panel-heading">
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-9">
							Contacts of {{ $account->name }}&nbsp;<span class="badge">{{ $contacts->count() }}</span>
						</div>
						@if(count($contacts))
							<div class="col-lg-3 col-md-3 col-sm-3">
								<a href="{{ url('contacts?account_id=' . $account->id) }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>More Contacts</span></a>
							</div>
						@endif
					</div>
				</div>

				<div class="panel-body">

					@if(count($contacts))
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Contact</th>
									<th>Email</th>
									<th>Account</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($contacts as $contact)
									<tr>
										<td>
											<div><a href="{{ url('contacts/'.$contact->id) }}">{{ $contact->firstname }}&nbsp;{{ $contact->lastname }}</a></div>
										</td>
										<td>
											<div>{{ $contact->email }}</div>
										</td>
										<td>
											<div>
												@isset($contact->account)
													{{ $contact->account->name }}
												@endisset
											</div>
										</td>
										<td class="actions">
											@can('edit-contact')
												<a href="{{ url('contacts/'.$contact->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
											@endcan

											@can('destroy-contact')
												<form action="{{ url('contacts/'.$contact->id) }}" method="POST" class="form-inline delete-action">
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
						<p>There is no contact yet.</p>
					@endif

				</div>

			</div><!-- End .panel-default -->

		</div>

	</div>

@endsection