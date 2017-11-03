<div class="row dashboard-tab">

	<div class="col-lg-12 col-md-12">

		<div class="sideTabs">

			<ul class="nav nav-tabs" role="tablist">
				<li class="item active">
					<a href="#ticket-list" aria-controls="ticket-list" role="presentation" data-toggle="tab">Tickets</a>
				</li>
				<li class="item">
					<a href="#task-list" aria-controls="task-list" role="presentation" data-toggle="tab">Tasks</a>
				</li>
				<li class="item">
					<a href="#planning-list" aria-controls="planning-list" role="presentation" data-toggle="tab">Planning</a>
				</li>
			</ul>

		</div>

		<!-- Tab panes -->
		<div class="tab-content">

			<div role="tabpanel" class="tab-pane margin-top active" id="ticket-list">

				<div class="panel panel-default">

					<div class="panel-body">

						@if(count($myTickets))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Status</th>
										<th>Ticket</th>
										<th>Account</th>
										<th>Assigned to</th>
										<th>Priority</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($myTickets as $ticket)
										<tr @isset($ticket->priority) class="{{ strtolower($ticket->priority->name) }}" @endisset>
											<td class="status">
												<button class="btn btn-xs btn-{{ $ticket->status->short_name }}">{{ $ticket->status->name }}</button>
											</td>
											<td class="ticket-name">
												<div><a href="{{ url('tickets/'.$ticket->id) }}"><strong>{{ $ticket->title }}</strong></a></div>
												<div><small>{{ $ticket->created_at }}</small></div>
											</td>
											<td class="account"><a href="{{ url('accounts/'.$ticket->account->id) }}">{{ $ticket->account->name }}</a></td>
											<td class="user">{{ $ticket->user->name }}</td>
											<td class="priority">@isset($ticket->priority) {{ $ticket->priority->name }} @endisset</td>
											<td class="actions">
												@can('edit-ticket')
													<a href="{{ url('tickets/'.$ticket->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
												@endcan
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>No tickets yet.</p>
						@endif

					</div><!-- End .panel-body -->

				</div><!-- End .panel -->

			</div><!-- End #ticket-list -->

			<div role="tabpanel" class="tab-pane margin-top" id="task-list">

				<div class="panel panel-default">

					<div class="panel-body">

						@if(count($myTasks))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Status</th>
										<th>Task</th>
										<th>Project</th>
										<th>Due</th>
									</tr>
								</thead>
								<tbody>
									@foreach($myTasks as $task)
										<tr>
											<td class="status">
												<button class="btn btn-xs btn-{{ $task->schedule->name }}">{{ $task->schedule->name }}</button>
											</td>
											<td>
												<a href="{{ url('tasks/' . $task->id) }}">{{ $task->name }}</a>
											</td>
											<td>
												<a href="{{ url('projects/' . $task->project->id) }}">{{ $task->project->name }}</a>
											</td>
											<td>{{ $task->due_date_time }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<p>No tasks yet.</p>
						@endif

					</div><!-- End .panel-body -->

				</div><!-- End .panel -->

			</div><!-- End #task-list -->

		</div><!-- End .tab-content -->

	</div>

</div>