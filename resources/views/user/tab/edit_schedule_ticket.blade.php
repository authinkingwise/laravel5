<div class="modal-dialog" role="document">
	
	<div class="modal-content">

		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Update Schedule - <span class="ticket-name"></span></h4>
		</div>

		<div class="modal-body">

			<form class="form-horizontal" action="{{ url('plannings') }}" method="POST" id="edit-schedule-ticket">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="form-group required">
					<label for="schedule_hours" class="col-sm-4 control-label">Scheduled Hours</label>
					<div class="col-sm-4">
						<input type="text" name="schedule_hours" class="form-control" id="schedule_hours" required="true">
					</div>
				</div>

				<div class="form-group">
					<label for="schedule_date" class="col-sm-4 control-label">Schedule Date</label>
					<div class="col-sm-4">
						<input type="text" name="schedule_date" class="form-control schedule_date">
					</div>
				</div>

				<div class="form-group">
					<label for="planning-description" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" id="planning-description" form="edit-schedule-ticket" rows="2"></textarea>
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

	</div>

</div>