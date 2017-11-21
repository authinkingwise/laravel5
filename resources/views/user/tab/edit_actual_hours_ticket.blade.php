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
					<label for="schedule_date" class="col-sm-4 control-label">Work Date</label>
					<div class="col-sm-4">
						<input type="text" name="schedule_date" class="form-control actual_date" disabled>
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
						<button type="submit" class="btn btn-danger" form="delete-actual-hours-ticket">Delete</button>
					</div>
					<div class="col-sm-8 text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" form="edit-actual-hours-ticket">Save</button>
					</div>
				</div>

			</form>

			<form action="{{ url('plannings') }}" method="POST" class="form-inline delete-action" id="delete-actual-hours-ticket">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" form="delete-actual-hours-ticket">
			    <input type="hidden" name="_method" value="DELETE" form="delete-actual-hours-ticket">
			</form>

		</div>

	</div>

</div>