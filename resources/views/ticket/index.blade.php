@extends('layouts.back')

@section('title')
Your Tickets
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">
						<span>
							@isset($myTicketsOnly)
								My tickets
							@else
								All tickets
							@endisset
						</span>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					@isset($myTicketsOnly)
						<a href="{{ url('tickets') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Tickets</span></a>
					@else
						<a href="{{ url('mytickets') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>My Tickets</span></a>
					@endif
				</div>

			</div>

			<div class="row">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<form class="form-inline pull-right filter-search" action="@empty($myTicketsOnly) {{ url('tickets') }} @else {{ url('mytickets') }} @endempty" method="GET">

						<div class="form-group">
    						<select name="account_id" class="form-control" id="account_id">
	                        	<option selected value> -- Select a Account -- </option>
	                            @foreach($accounts as $account)
	                                <option value="{{ $account->id }}" @if($request['account_id'] == $account->id) selected @endif>{{ $account->name }}</option>
	                            @endforeach
	                        </select>
    					</div>

    					@empty($myTicketsOnly)
	    					<div class="form-group">
	    						<select name="user_id" class="form-control" id="user_id">
		                        	<option selected value> -- Assign to -- </option>
		                            @foreach($users as $user)
		                                <option value="{{ $user->id }}" @if($request['user_id'] == $user->id) selected @endif>{{ $user->name }}</option>
		                            @endforeach
		                        </select>
	    					</div>
    					@endempty

    					<div class="form-group">
    						<select name="status_id" class="form-control" id="status_id">
	                        	<option selected value> -- Status -- </option>
	                            @foreach($statuses as $status)
	                                <option value="{{ $status->id }}" @if($request['status_id'] == $status->id) selected @endif>{{ $status->name }}</option>
	                            @endforeach
	                        </select>
    					</div>

    					<div class="form-group">
    						<select name="orderby" class="form-control" id="orderby">
	                        	<option selected value> -- Update time -- </option>
	                        	<option value="asc" @if($request['orderby'] == 'asc') selected @endif>Ascending</option>
	                            <option value="desc" @if($request['orderby'] != 'asc') selected @endif>Descending</option>
	                        </select>
    					</div>

    					<button type="submit" class="btn btn-skyblue btn-sm"><i class="fa fa-search"></i><span>Search</span></button>

					</form>

				</div>

			</div>

			<div class="row task-list">
				<div class="col-lg-12 col-md-12 col-sm-12">

					<div class="panel panel-default">

						<div class="panel-body">

							@if(count($tickets))
								@can('show-ticket')
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Status</th>
												<th>Ticket</th>
												<th>Account</th>
												<th>Assigned to</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($tickets as $ticket)
												<tr>
													<td class="status">
														<button class="btn btn-xs btn-{{ $ticket->status->short_name }}">{{ $ticket->status->name }}</button>
													</td>
													<td class="ticket-name">
														<div><a href="{{ url('tickets/'.$ticket->id) }}"><strong>{{ $ticket->title }}</strong></a></div>
														<div><small>{{ $ticket->created_at }}</small></div>
													</td>
													<td class="account"><a href="{{ url('accounts/'.$ticket->account->id) }}">{{ $ticket->account->name }}</a></td>
													<td class="user">{{ $ticket->user->name }}</td>
													<td class="actions">
														@can('edit-ticket')
															<a href="{{ url('tickets/'.$ticket->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
														@endcan
														@can('destroy-ticket')
															<form action="{{ url('tickets/'.$ticket->id) }}" method="POST" class="form-inline delete-action">
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
									<p>No ticket is shown due to permission.</p>
								@endcan
							@else
								<p>There is no ticket yet.</p>
							@endif

						</div>

					</div>

				</div>
			</div><!-- End .row -->

			<div class="clearfix">
				<ul class="pull-right">
					@isset($user)
						{{ $tickets->appends($_REQUEST)->links() }}
					@else
						{{ $tickets->links() }}
					@endisset
				</ul>
			</div>

		</div>

	</div>

@endsection
