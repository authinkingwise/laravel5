<div class="row">

	<div class="col-lg-12 col-md-12">

		<div class="sideTabs">

			<ul class="nav nav-tabs" role="tablist">
				<li class="item <?php if(isset($_GET['week']) == false) echo 'active'; ?>">
					<a href="#ticket-list" aria-controls="ticket-list" role="presentation" data-toggle="tab">Tickets</a>
				</li>
				<li class="item">
					<a href="#task-list" aria-controls="task-list" role="presentation" data-toggle="tab">Tasks</a>
				</li>
				<li class="item <?php if(isset($_GET['week'])) echo 'active'; ?>">
					<a href="#planning-list" aria-controls="planning-list" role="presentation" data-toggle="tab">Planning</a>
				</li>
			</ul>

		</div>

		<!-- Tab panes -->
		<div class="tab-content">

			<div role="tabpanel" class="tab-pane margin-top <?php if(isset($_GET['week']) == false) echo 'active'; ?>" id="ticket-list">

				<div class="panel panel-default">

					<div class="panel-body">

						@if(count($tickets))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Status</th>
										<th>Ticket</th>
										<th>Account</th>
										<th>Priority</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($tickets as $ticket)
										<tr @isset($ticket->priority) class="{{ strtolower($ticket->priority->name) }}" @endisset>
											<td class="status">
												<button class="btn btn-xs btn-{{ $ticket->status->short_name }}">{{ $ticket->status->name }}</button>
											</td>
											<td class="ticket-name">
												<div><a href="{{ url('tickets/'.$ticket->id) }}"><strong>{{ $ticket->title }}</strong></a></div>
												<div><small>{{ $ticket->created_at }}</small></div>
											</td>
											<td class="account"><a href="{{ url('accounts/'.$ticket->account->id) }}">{{ $ticket->account->name }}</a></td>
											<td class="priority">@isset($ticket->priority) {{ $ticket->priority->name }} @endisset</td>
											<td class="actions">
												<button class="btn btn-default btn-sm schedule-ticket" title="Schedule ticket" data-toggle="modal" data-target="#schedule-ticket-modal" data-ticket="{{ $ticket->id }}">
													<i class="fa fa-calendar"></i>
													<span>Schedule</span>
												</button>
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

						@if(count($tasks))
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Status</th>
										<th>Task</th>
										<th>Project</th>
										<th>Due</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($tasks as $task)
										<tr>
											<td class="status">
												<button class="btn btn-xs btn-{{ $task->schedule->name }}">{{ $task->schedule->name }}</button>
											</td>
											<td>{{ $task->name }}</td>
											<td>
												<a href="{{ url('projects/' . $task->project->id) }}">{{ $task->project->name }}</a>
											</td>
											<td>{{ $task->due_date_time }}</td>
											<td class="actions">
												<button class="btn btn-default btn-sm schedule-task" title="Schedule task" data-toggle="modal" data-target="#schedule-task-modal" data-task="{{ $task->id }}" data-project="{{ $task->project->id }}">
													<i class="fa fa-calendar"></i>
													<span>Schedule</span>
												</button>
											</td>
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

			<div role="tabpanel" class="tab-pane margin-top <?php if(isset($_GET['week'])) echo 'active'; ?>" id="planning-list">

				<div class="panel panel-default">

					<div class="page-heading panel-heading">
						<span>Ticket Planning</span>
						<span class="planning-pagination pull-right">
							<a href="{{ url('users/'.$user->id.'?week='.($week_page-1)) }}" class="btn btn-sm btn-skyblue" alt="previous week" title="previous week"><span>Prev week</span></a>
							<a href="{{ url('users/'.$user->id.'?week='.($week_page+1)) }}" class="btn btn-sm btn-skyblue" alt="next week" title="next week"><span>Next week</span></a>
						</span>
					</div>

					<div class="panel-body">

						<?php
							$today_num = (int)date('w'); // Numeric representation of the day of the week.
						?>

						@if(count($ticket_plannings))

							<ul class="plan-list">

								<li>
									<div class="row">
										<div class="col-md-7 col-md-offset-5 calendar-range">
											<div class="row">
												<div class="col-md-7 text-center bold">
													<?php
														if ($today_num <= 1) {
															echo date('M d', strtotime('monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
														} else {
															echo date('M d', strtotime('last monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
														}
													?>
												</div>
											</div>
										</div>

										<div class="col-md-7 col-md-offset-5">
											<div class="row">
												{{--
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 1) black @endif">
													@if ($today_num <= 1)
														{{ date('D j', strtotime('monday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last monday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 2) black @endif">
													@if ($today_num <= 2)
														{{ date('D j', strtotime('tuesday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last tuesday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 3) black @endif">
													@if ($today_num <= 3)
														{{ date('D j', strtotime('wednesday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last wednesday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 4) black @endif">
													@if ($today_num <= 4)
														{{ date('D j', strtotime('thursday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last thursday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 5) black @endif">
													@if ($today_num <= 5)
														{{ date('D j', strtotime('friday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last friday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 6) black @endif">
													{{ date('D j', strtotime('saturday +' . $week_page . ' week')) }}
												</span>
												<span class="slot col-md-1 no-padding @if($week_page == 0 && $today_num == 0) black @endif">
													@if ($today_num == 0)
														{{ date('D j', strtotime('last sunday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('sunday +' . $week_page . ' week')) }}
													@endif
												</span>
												--}}
												<?php
													for ($i = 1; $i <= 7; $i++) { // from monday to sunday
														// textual representation of the day of the week
														switch ($i) {
															case 7:
																$today_day = 'sunday';
																break;
															case 1:
																$today_day = 'monday';
																break;
															case 2:
																$today_day = 'tuesday';
																break;
															case 3:
																$today_day = 'wednesday';
																break;
															case 4:
																$today_day = 'thursday';
																break;
															case 5:
																$today_day = 'friday';
																break;
															case 6:
																$today_day = 'saturday';
																break;
															default:
																$today_day = 'monday';
																break;
														} ?>
														<span class="slot col-md-1 no-padding head <?php if($week_page == 0 && ($today_num == $i || ($i == 7 && $today_num == 0) )) echo 'black'; ?>">
															<?php
																if ($today_num <= $i) {
																	echo date('D j', strtotime($today_day . ' +' . $week_page . ' week'));
																} else {
																	echo date('D j', strtotime('last ' . $today_day . ' +' . $week_page . ' week'));
																}
															?>
														</span>
												<?php }
												?>

												<span class="slot col-md-1 no-padding head">
													SUM
												</span>
											</div>
										</div>
									</div>
								</li>
								{{--
								@foreach($ticket_plannings as $key => $planning)
									<li class="row">
										<div class="col-md-5">
											<div class="ticket-title">
												@if($planning->ticket_id)
													<a href="{{ url('tickets/'.$planning->ticket->id) }}" class="black bold">{{ $planning->ticket->title }}</a>
												@endif
											</div>
										</div>
										<div class="col-md-7">
											<div class="row">
												@php
													$day = (int)date('w', strtotime($planning->schedule_date));
												@endphp
												
												@for ($i = 1; $i <= 7; $i++)
													<span class="slot col-md-1 no-padding">
														@if($day == $i)
															{{ $planning->schedule_hours . 'h' }}
														@endif
													</span>
												@endfor

												<span class="slot col-md-1 no-padding">
													{{ $ticket_plannings->sum('schedule_hours') }}
												</span>
											</div>
										</div>
									</li>
								@endforeach
								--}}

								@foreach($ticket_plannings as $key => $items)
									<li class="single">
										<div class="row">
											<div class="col-md-5">
												<div class="ticket-title">
													<a href="{{ url('tickets/'.$key) }}" class="black bold">{{ \App\Models\Ticket::findOrFail($key)->title }}</a>
												</div>
											</div>
											<div class="col-md-7">
												<div class="row">
													@for ($i = 1; $i <= 7; $i++)
														@php
															$matched = false; // check if it is the scheduled item
														@endphp

														<span class="slot col-md-1 no-padding">
															@foreach($items as $item)
																<?php 
																	// Numeric representation of the schedule date of the week.
																	$day = (int)date('w', strtotime($item->schedule_date)); 
																?>
																@if($day == $i)

																	@php
																		$matched = true;
																	@endphp

																	@if($item->schedule_hours > 0)
																		<div class="schedule-hour-num" title="Edit" data-toggle="modal" data-target="#edit-schedule-ticket-modal" data-planning="{{ $item->id }}" data-toggle="tooltip" data-placement="right">
																		{{ $item->schedule_hours . 'h' }}
																	</div>
																	@else
																		<div class="zero-hour-num" data-planning="{{ $item->id }}"></div>
																	@endif

																	@if($item->actual_hours > 0)
																		<div class="actual-hour-num" title="actual hours">{{ $item->actual_hours . 'h' }}</div>
																	@endif
																
																@endif
															@endforeach

															@if($matched == false)
																<div class="schedule-hour-num no-schedule" title="Update actual hours" data-ticket="{{ $key }}" data-toggle="modal" data-target="#add-actual-hours-ticket-modal" data-date="<?php echo date('Y-m-d', strtotime($week_page*7+$i-$today_num . ' day')); ?>" data-toggle="tooltip" data-placement="right"></div>
															@endif
														</span>
													@endfor
													<span class="slot col-md-1 no-padding">
														<div class="schedule-hour-num" title="Total schedule" data-toggle="tooltip" data-placement="right">
															{{ $items->sum('schedule_hours') . 'h' }}
														</div>
														@if ($items->sum('actual_hours') > 0)
															<div class="actual-hour-num" title="actual hours">
																{{ $items->sum('actual_hours') . 'h' }}
															</div>
														@endif
													</span>
												</div>
											</div>
										</div>
									</li>
								@endforeach

							</ul>

						@else

							<p>No ticket planning yet on this week 
								<?php
									if ($today_num <= 1) {
										echo date('M d', strtotime('monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
									} else {
										echo date('M d', strtotime('last monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
									}
								?>
							</p>

						@endif

					</div><!-- End .panel-body -->

				</div><!-- End .panel -->

				<div class="panel panel-default">

					<div class="page-heading panel-heading">
						<span>Project Planning</span>
						<span class="planning-pagination pull-right">
							<a href="{{ url('users/'.$user->id.'?week='.($week_page-1)) }}" class="btn btn-sm btn-skyblue" alt="previous week" title="previous week"><span>Prev week</span></a>
							<a href="{{ url('users/'.$user->id.'?week='.($week_page+1)) }}" class="btn btn-sm btn-skyblue" alt="next week" title="next week"><span>Next week</span></a>
						</span>
					</div>

					<div class="panel-body">

						@if(count($task_plannings))

							<ul class="plan-list">

								<li>
									<div class="row">
										<div class="col-md-7 col-md-offset-5 calendar-range">
											<div class="row">
												<div class="col-md-7 text-center bold">
													<?php
														if ($today_num <= 1) {
															echo date('M d', strtotime('monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
														} else {
															echo date('M d', strtotime('last monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
														}
													?>
												</div>
											</div>
										</div>

										<div class="col-md-7 col-md-offset-5">
											<div class="row">
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 1) black @endif">
													@if ($today_num <= 1)
														{{ date('D j', strtotime('monday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last monday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 2) black @endif">
													@if ($today_num <= 2)
														{{ date('D j', strtotime('tuesday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last tuesday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 3) black @endif">
													@if ($today_num <= 3)
														{{ date('D j', strtotime('wednesday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last wednesday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 4) black @endif">
													@if ($today_num <= 4)
														{{ date('D j', strtotime('thursday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last thursday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 5) black @endif">
													@if ($today_num <= 5)
														{{ date('D j', strtotime('friday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('last friday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 6) black @endif">
													{{ date('D j', strtotime('saturday +' . $week_page . ' week')) }}
												</span>
												<span class="slot col-md-1 no-padding head @if($week_page == 0 && $today_num == 0) black @endif">
													@if ($today_num == 0)
														{{ date('D j', strtotime('last sunday +' . $week_page . ' week')) }}
													@else
														{{ date('D j', strtotime('sunday +' . $week_page . ' week')) }}
													@endif
												</span>
												<span class="slot col-md-1 no-padding head">
													SUM
												</span>
											</div>
										</div>
									</div>
								</li>

								@foreach($task_plannings as $key => $items)
									<li>
										<ul>
											@foreach($items as $item)
												<li class="row">
													<div class="col-md-5">
														<div class="task-name">
															{{ $item->task->name }}
														</div>
														<div class="project-name">
															<a href="{{ url('projects/'.$key) }}">{{ \App\Models\Project::findOrFail($key)->name }}</a>&nbsp;(project)
														</div>
													</div>
													<div class="col-md-7">
														<div class="row">
															<?php 
																// Numeric representation of the schedule date of the week.
																$day = (int)date('w', strtotime($item->schedule_date)); 
															?>
															<!-- schedule hours for the work -->
															@for ($i = 1; $i <= 7; $i++)
																<span class="slot col-md-1 no-padding">
																	@if($day == $i)
																		{{ $item->schedule_hours . 'h' }}
																	@endif
																</span>
															@endfor
															<span class="slot col-md-1 no-padding">
																{{ $items->sum('schedule_hours') . 'h' }}
															</span>
														</div>
													</div>
												</li>
											@endforeach
										</ul>
									</li>
								@endforeach

							</ul>

						@else

							<p>No project planning yet on this week 
								<?php
									if ($today_num <= 1) {
										echo date('M d', strtotime('monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
									} else {
										echo date('M d', strtotime('last monday +' . $week_page . ' week')) . " - " . date('M d', strtotime('sunday +' . $week_page . ' week'));
									}
								?>
							</p>

						@endif
						
					</div><!-- End .panel-body -->
					
				</div>

			</div><!-- End #planning-list -->

		</div><!-- End .tab-content -->

	</div>

</div>

<div class="modal fade" id="schedule-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
	@include('user.tab.schedule_ticket')
</div><!-- End #schedule-ticket-modal -->

<div class="modal fade" id="schedule-task-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
	@include('user.tab.schedule_task')
</div><!-- End #schedule-task-modal -->

<div class="modal fade" id="edit-schedule-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
	@include('user.tab.edit_schedule_ticket')
</div><!-- End #edit-schedule-ticket-modal -->

<div class="modal fade" id="add-actual-hours-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
	@include('user.tab.add_actual_hours_ticket')
</div><!-- End #add-actual-hours-ticket-modal -->

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>