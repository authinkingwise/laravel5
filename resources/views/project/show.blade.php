@extends('layouts.back')

@section('title')
Project
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Project - {{ $project->name }}</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('projects') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Projects</span></a>
		</div>

	</div>

	<div class="row project-details">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-heading">
					
					@can('edit-project')
						<button class="btn btn-default btn-sm" title="Edit project" data-toggle="modal" data-target="#edit-project-modal">
							<i class="fa fa-folder-open"></i>
							<span>Edit</span>
						</button>
					@endcan
					@can('create-task')
						<button class="btn btn-skyblue btn-sm" title="Add a new task to this project" data-toggle="modal" data-target="#create-task-modal">
							<i class="fa fa fa-plus-circle"></i>
							<span>Create Task</span>
						</button>
					@endcan

				</div>

				<div class="panel-body">

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Status:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@if($project->status)
								Active
							@else
								Inactive
							@endif
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Account (client):</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->account)
								<a href="{{ url('account/' . $project->account->id) }}">{{ $project->account->name }}</a>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Assign to (Manager):</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->user)
								{{ $project->user->name }}
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Created by:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->creator)
								<span>{{ $project->creator->name }}</span>&nbsp;&nbsp;<small>{{ $project->created_at }}</small>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Last Updated by:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->lastUpdateUser)
								<span>{{ $project->lastUpdateUser->name }}</span>&nbsp;&nbsp;<small>{{ $project->updated_at }}</small>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Description:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<div class="text-desc">{!! $project->description !!}</div>
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Visible:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@if($project->visible)
								everyone
							@elseif($allowed_users != null)
								@if(count($allowed_users) == 1)
									@foreach($allowed_users as $user)
										{{ $user->name }}
									@endforeach
								@else
									@foreach($allowed_users as $index => $user)
										@if ($loop->last)
											{{ $user->name . '.' }}
										@else
											{{ $user->name . ', ' }}
										@endif
									@endforeach
								@endif
							@endif
						</div>
					</dl>

					@if($project->projectFiles->count() > 0)
						<dl class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<div class="pull-right">
									<label>Attachment:</label>
								</div>
							</div>

							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<div>
									@foreach($project->projectFiles as $attachment)
										<a href="{{ url('projectfiles/' . $attachment->id) }}">{{ $attachment->file }}</a>
									@endforeach
								</div>
							</div>
						</dl>
					@endif

				</div>

			</div>

		</div>

	</div><!-- End .project-details -->

	@if(count($tasks))
	<div class="row tasks">

		<div class="col-lg-3 col-md-4 col-sm-12">

			<div class="panel panel-default">

				<div class="panel-heading bg-info">Someday</div>

				<div class="panel-body">

					<ul class="list-unstyled list-tasks" id="list-new-tasks" data-schedule="1">
						@foreach($newTasks as $task)
							<li data-parent="{{ $project->id }}" 
								data-task="{{ $task->id }}" 
								data-schedule="{{ $task->schedule_id }}" 
								data-name="{{ $task->name }}"
								@cannot('edit-task') class="no-permission" @endcannot>
								<div class="task-name" data-toggle="modal" data-target="#show-task-modal" data-task="{{ $task->id }}">
									{{ $task->name }}
								</div>
								<div class="photo profile">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="user">{{ $task->user->name }}</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 text-right">
											<div class="task-created-at">{{ $task->created_at->format('Y-m-d') }}</div>
										</div>
									</div>
								</div>
								<div class="action row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<span class="schedule-name">{{ $task->schedule->name }}</span>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 text-right">
										<button class="btn btn-xs btn-info new-button" data-task="{{ $task->id }}">Start</button>
									</div>
								</div>
							</li>
						@endforeach
					</ul>

				</div>

			</div>

		</div><!-- End .col-lg-3 -->

		<div class="col-lg-3 col-md-4 col-sm-12">

			<div class="panel panel-default">

				<div class="panel-heading bg-danger">To Do</div>

				<div class="panel-body">

					<ul class="list-unstyled list-tasks" id="list-todo-tasks" data-schedule="2">
						@foreach($todoTasks as $task)
							<li data-parent="{{ $project->id }}" 
								data-task="{{ $task->id }}" 
								data-schedule="{{ $task->schedule_id }}" 
								data-name="{{ $task->name }}"
								@cannot('edit-task') class="no-permission" @endcannot>
								<div class="task-name" data-toggle="modal" data-target="#show-task-modal" data-task="{{ $task->id }}">
									{{ $task->name }}
								</div>
								<div class="photo profile">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="user">{{ $task->user->name }}</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 text-right">
											<div class="task-created-at">{{ $task->created_at->format('Y-m-d') }}</div>
										</div>
									</div>
								</div>
								<div class="action row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<span class="schedule-name">{{ $task->schedule->name }}</span>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 text-right">
										<button class="btn btn-xs btn-danger new-button" data-task="{{ $task->id }}">Start</button>
									</div>
								</div>
							</li>
						@endforeach
					</ul>

				</div>

			</div>

		</div><!-- End .col-lg-3 -->

		<div class="col-lg-3 col-md-4 col-sm-12">

			<div class="panel panel-default">

				<div class="panel-heading bg-warning">Working On</div>

				<div class="panel-body">

					<ul class="list-unstyled list-tasks" id="list-workingon-tasks" data-schedule="3">
						@foreach($workingOnTasks as $task)
							<li data-parent="{{ $project->id }}" 
								data-task="{{ $task->id }}" 
								data-schedule="{{ $task->schedule_id }}" 
								data-name="{{ $task->name }}"
								@cannot('edit-task') class="no-permission" @endcannot>
								<div class="task-name" data-toggle="modal" data-target="#show-task-modal" data-task="{{ $task->id }}">
									{{ $task->name }}
								</div>
								<div class="photo profile">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="user">{{ $task->user->name }}</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 text-right">
											<div class="task-created-at">{{ $task->created_at->format('Y-m-d') }}</div>
										</div>
									</div>
								</div>
								<div class="action row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<span class="schedule-name">{{ $task->schedule->name }}</span>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 text-right">
										@if($task->schedule_id == 3)
											<button class="btn btn-xs btn-warning finish-button" data-task="{{ $task->id }}">Finish</button>
										@elseif($task->schedule_id == 4)
											<button class="btn btn-xs btn-success accept-button" data-task="{{ $task->id }}">Accept</button>
											<button class="btn btn-xs btn-danger reject-button" data-task="{{ $task->id }}">Reject</button>
										@elseif($task->schedule_id == 5)
											<button class="btn btn-xs btn-primary restart-button" data-task="{{ $task->id }}">Restart</button>
										@endif
									</div>
								</div>
							</li>
						@endforeach
					</ul>

				</div>

			</div>

		</div><!-- End .col-lg-3 -->

		<div class="col-lg-3 col-md-4 col-sm-12">

			<div class="panel panel-default">

				<div class="panel-heading bg-success">Completed</div>

				<div class="panel-body">

					<ul class="list-unstyled list-tasks" id="list-completed-tasks" data-schedule="6">
						@foreach($completedTasks as $task)
							<li data-parent="{{ $project->id }}" 
								data-task="{{ $task->id }}" 
								data-schedule="{{ $task->schedule_id }}" 
								data-name="{{ $task->name }}"
								@cannot('edit-task') class="no-permission" @endcannot>
								<div class="task-name" data-toggle="modal" data-target="#show-task-modal" data-task="{{ $task->id }}">
									{{ $task->name }}
								</div>
								<div class="photo profile">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6">
											<div class="user">{{ $task->user->name }}</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 text-right">
											<div class="task-created-at">{{ $task->created_at->format('Y-m-d') }}</div>
										</div>
									</div>
								</div>
								<div class="action row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<span class="schedule-name">{{ $task->schedule->name }}</span>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 text-right">
										<button class="btn btn-xs btn-info new-button" data-task="{{ $task->id }}">Complete</button>
									</div>
								</div>
							</li>
						@endforeach
					</ul>

				</div>

			</div>

		</div><!-- End .col-lg-3 -->

	</div><!-- End .tasks -->
	@else
		<p>There is no task for this project yet.</p>
	@endif

	<div class="modal fade" id="edit-project-modal" tabindex="-1" role="dialog" aria-labelledby="edit-project-modal-label">
		@include('project.edit')
	</div><!-- End #edit-project-modal -->

	<div class="modal fade" id="create-task-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
		@include('task.create')
	</div><!-- End #create-task-modal -->

	<!-- View & Edit task modal -->
	<div class="modal fade" id="show-task-modal" tabindex="-1" role="dialog" aria-labelledby="show-task-modal-label">
		@include('task.edit')
	</div><!-- End #show-task-modal -->

	@include('modal.dialog-permission')

@endsection

@section('javascript')
	<script type="text/javascript">var url_get_task = "{{ url('tasks') }}";</script>
	@parent
@endsection