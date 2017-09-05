@extends('layouts.back')

@section('title')
Dashboard
@endsection

@section('content')

	<div class="content">
		
		<div class="container-fluid">

			<div class="row">
				
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="page-heading">Your tickets</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<a href="#" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Ticket</span></a>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2">
					<select class="form-control">
						<option>Sort by priority</option>
						<option>Sort by date</option>
					</select>
				</div>

			</div>

			<div class="row task-list">
				<div class="col-lg-12 col-md-12 col-sm-12">

					<div class="panel panel-default">

						<div class="panel-body">

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
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-primary">in progress</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-info">assigned</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-danger">new</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-danger">New</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-warning">pending</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
									<tr>
										<td class="status">
											<button class="btn btn-xs btn-success">complete</button>
										</td>
										<td class="ticket-name">
											<div><a href="{{ url('ticket/view/') }}"><strong>Google Shopping Cart Certificate install</strong></a></div>
											<div><small>2017-07-11 16:58:15</small></div>
										</td>
										<td class="account"><a href="{{ url('account/view/') }}">NewQuest</a></td>
										<td class="user">Terry Ye</td>
										<td class="actions">
											<a href="{{ url('ticket/view/') }}" class="btn btn-default btn-sm"><i class="fa fa-folder-open"></i>View</a>
											<a href="{{ url('ticket/edit/') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>
											<a href="{{ url('ticket/delete/') }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i>Delete</a>
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>

				</div>
			</div>

		</div>

	</div>

@endsection
