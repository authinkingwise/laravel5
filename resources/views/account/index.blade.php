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
					<div class="page-heading">Your accounts</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<a href="{{ url('account/add') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Account</span></a>
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
												<div><a href="{{ url('account/view/' . $account->id) }}"><strong>{{ $account->name }}</strong></a></div>
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
												<a href="{{ url('account/view/' . $account->id) }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i><span class="hidden-xs">View</span></a>
												
												<a href="{{ url('account/edit/' . $account->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
												
												<a href="{{ url('account/delete/' . $account->id) }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></a>
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