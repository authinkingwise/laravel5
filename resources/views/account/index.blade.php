@extends('layouts.back')

@section('title')
Accounts
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			@include('layouts.message')

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">Your accounts&nbsp;<span class="badge">{{ $accounts->count() }}</span></div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<a href="{{ url('accounts/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Account</span></a>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2">
					<select class="form-control">
						<option>Sort by A-Z</option>
						<option>Sort by date</option>
					</select>
				</div>

			</div>

			<div class="row account-list">

				<div class="col-lg-12 col-md-12 col-sm-12">

					<div class="panel panel-default">

						<div class="panel-body">

							@if(count($accounts))
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Account</th>
											<th class="hidden-xs">Email</th>
											<th class="hidden-xs">Phone</th>
											<th class="hidden-xs">Website</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									@foreach($accounts as $account)
										<tr>
											<td class="account-name">
												<div><a href="{{ url('accounts/' . $account->id) }}"><strong>{{ $account->name }}</strong></a></div>
											</td>
											<td class="account-email hidden-xs">
												<div>{{ $account->email }}</div>
											</td>
											<td class="account-phone hidden-xs">
												<div>{{ $account->phone }}</div>
											</td>
											<td class="account-website hidden-xs">
												@isset($account->website)<a href="{{ $account->website }}" target="_blank">{{ $account->website }}</a>@endif
											</td>
											<td class="actions">
												@can('edit-account')
													<a href="{{ url('accounts/' . $account->id . '/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
												@endcan
												
												@can('destroy-account')
													<form action="{{ url('accounts/'.$account->id) }}" method="POST" class="form-inline delete-action">
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
								<p>There is no account yet.</p>
							@endif

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

@endsection