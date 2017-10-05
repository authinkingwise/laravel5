<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Edit task</h4>
		</div>

		<div class="modal-body">
			<form class="form-horizontal" action="{{ url('tasks') }}" method="POST" enctype="multipart/form-data" id="edit-task-form">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<input type="hidden" name="form-modal" id="form-modal-add" value="1">

				<div class="form-group required">
					<label for="task-name" class="col-sm-4 control-label">Task Name</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" id="task-name" required="true" @cannot('edit-task') disabled @endcannot>
					</div>
				</div>

				<div class="form-group">
					<label for="task-schedule_id" class="col-sm-4 control-label">Schedule</label>
					<div class="col-sm-8">
						<select name="schedule_id" class="form-control" id="task-schedule_id" @cannot('edit-task') disabled @endcannot>
							@foreach($schedules as $schedule)
								<option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<input type="hidden" name="project_id" id="task-project_id" value="{{ $project->id }}">
				
				<div class="form-group required">
					<label for="task-user_id" class="col-sm-4 control-label">Assigned to</label>
					<div class="col-sm-8">
						<select name="user_id" class="form-control" id="task-user_id" required="true" @cannot('edit-task') disabled @endcannot>
							<option disabled selected value> -- Select a user -- </option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="task-due_date_picker" class="col-sm-4 control-label">Due on</label>
					<div class="col-sm-4">
						<input type="text" name="due_date_picker" class="form-control" id="task-due_date_picker" @cannot('edit-task') disabled @endcannot>
					</div>
					<input type="hidden" name="due_date_time" id="task-due_date_time">
				</div>

				<div class="form-group">
					<label for="task-description" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						@can('edit-task')
							<textarea name="description" class="form-control" id="task-description" form="edit-task-form" rows="5"></textarea>
						@else
							<textarea name="description" class="form-control no-editor" id="task-description" form="edit-task-form" rows="5" disabled></textarea>
						@endcannot
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10 text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
