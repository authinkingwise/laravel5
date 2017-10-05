<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modal-label">Add a new task</h4>
		</div>

		<div class="modal-body">
			<form class="form-horizontal" action="{{ url('tasks') }}" method="POST" enctype="multipart/form-data" id="create-task-form">

				{{ csrf_field() }}

				<input type="hidden" name="form-modal" id="form-modal-add" value="1">

				<div class="form-group required">
					<label for="name" class="col-sm-4 control-label">Task Name</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" id="name" required="true">
					</div>
				</div>

				<div class="form-group">
					<label for="schedule_id" class="col-sm-4 control-label">Schedule</label>
					<div class="col-sm-8">
						<select name="schedule_id" class="form-control" id="schedule_id">
							@foreach($schedules as $schedule)
								<option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
				
				<div class="form-group required">
					<label for="user_id" class="col-sm-4 control-label">Assigned to</label>
					<div class="col-sm-8">
						<select name="user_id" class="form-control" id="user_id" required="true">
							<option disabled selected value> -- Select a user -- </option>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="due_date_picker" class="col-sm-4 control-label">Due on</label>
					<div class="col-sm-4">
						<input type="text" name="due_date_picker" class="form-control" id="due_date_picker">
					</div>
					<input type="hidden" name="due_date_time" id="due_date_time">
				</div>

				<div class="form-group">
					<label for="description" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" id="description" form="create-task-form" rows="5"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10 text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</div>
			</form>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
