<div class="modal-dialog" role="document">
	
	<div class="modal-content">

		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Add actual working hours - <span class="ticket-name"></span></h4>
		</div>

		<div class="modal-body">

			<form class="form-horizontal" action="{{ url('plannings') }}" method="POST" id="add-actual-hours-ticket">

				{{ csrf_field() }}

				<input type="hidden" name="ticket_id" id="ticket_id" value="">

				<input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

				<div class="form-group">
					<label for="actual_date" class="col-sm-4 control-label">Work Date</label>
					<div class="col-sm-4">
						<input type="text" name="actual_date" class="form-control actual_date" readonly="readonly">
					</div>
				</div>

				<div class="form-group required">
					<label for="actual_hours" class="col-sm-4 control-label">Actual Work Hours</label>
					<div class="col-sm-4">
						<input type="text" name="actual_hours" class="form-control" id="actual_hours" required="true">
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

	</div>

</div>