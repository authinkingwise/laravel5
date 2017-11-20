<div class="modal-dialog" role="document">
	
	<div class="modal-content">

		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Edit actual working hours - <span class="ticket-name"></span></h4>
		</div>

		<div class="modal-body">

			<form class="form-horizontal" action="{{ url('plannings') }}" method="POST" id="edit-actual-hours-ticket">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="form-group">
					<label for="schedule_date" class="col-sm-4 control-label">Schedule Date</label>
					<div class="col-sm-4">
						<input type="text" name="schedule_date" class="form-control schedule_date" disabled>
					</div>
				</div>

				<div class="form-group required">
					<label for="actual_hours" class="col-sm-4 control-label">Actual Work Hours</label>
					<div class="col-sm-4">
						<input type="text" name="actual_hours" class="form-control" id="actual_hours" required="true">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-4 text-right">
						<button type="button" class="btn btn-danger" form="delete-planning">Delete</button>
					</div>
					<div class="col-sm-8 text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>

			</form>

			<form action="{{ url('plannings') }}" method="POST" class="form-inline delete-action" id="delete-planning">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" form="delete-planning">
			    <input type="hidden" name="_method" value="DELETE" form="delete-planning">
			</form>

		</div>

	</div>

</div>