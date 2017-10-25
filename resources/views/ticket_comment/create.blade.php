<div class="panel panel-default" id="add_comment">

	<div class="page-heading panel-heading">Add comment</div>

	<div class="panel-body">

		<form class="form-horizontal" action="{{ url('comments') }}" method="POST" id="commentform" enctype="multipart/form-data">

			{{ csrf_field() }}

			<input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

			<div class="row form-group">

				<div class="col-sm-3">
					<label for="status_id"><strong>Status</strong></label>
					<select name="status_id" class="form-control" id="status_id">
	                    @foreach($statuses as $status)
	                        <option value="{{ $status->id }}" 
	                        	@if(old('status_id') == $status->id) 
	                        		selected
	                        	@else
	                        		@isset($ticket->status)
	                        			@if($status->id == $ticket->status->id)
                                            selected
                                        @endif
	                        		@endisset
	                        	@endif>
	                        	{{ $status->name }}
	                        </option>
	                    @endforeach
	                </select>
				</div>

				<div class="col-sm-3">
					<label for="user_id"><strong>Assign to</strong></label>
					<select name="user_id" class="form-control" id="user_id">
	                    <option selected value="{{ old('user_id') ?: '' }}"> -- Select a User -- </option>
	                    @foreach($users as $user)
	                        <option value="{{ $user->id }}" 
	                        	@if(old('user_id') == $user->id) 
	                        		selected
	                        	@else
	                        		@isset($ticket->user)
                                        @if($user->id == $ticket->user->id)
                                        	selected
                                        @endif
                                    @endisset
	                        	@endif>
	                        	{{ $user->name }}
	                       	</option>
	                    @endforeach
	                </select>
				</div>

				<div class="col-sm-3">
					<label for="priority_id"><strong>Priority</strong></label>
					<select name="priority_id" class="form-control" id="priority_id">
	                    @foreach($priorities as $priority)
	                        <option value="{{ $priority->id }}" 
	                        	@if(old('priority_id') == $priority->id) 
	                        		selected
	                        	@else
	                        		@isset($ticket->priority)
                                        @if($priority->id == $ticket->priority->id)
                                            selected
                                        @endif
                                    @endisset
	                        	@endif>
	                        	{{ $priority->name }}
	                        </option>
	                    @endforeach
	                </select>
				</div>

				<div class="col-sm-3{{ $errors->has('time') ? ' has-error' : '' }}">
					<label for="time"><strong>House Spent</strong></label>
					<input type="text" name="time" class="form-control" id="time" value="{{ old('time') ?: '' }}">

					@if ($errors->has('time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
				</div>

			</div>

			<div class="form-group">
				<div class="col-sm-12">
					<textarea name="comment_description" class="form-control" id="comment_description" rows="3" form="commentform">{{ old('comment_description') ?: '' }}</textarea>
				</div>
			</div>

			<div class="form-group">
                <label for="files" class="col-sm-2 control-label">Upload File</label>
                <div class="col-sm-4">
                    <input type="file" name="files[]" class="form-control">
                    <span class="btn btn-warning btn-sm" id="add-file"><i class="fa fa fa-plus-circle"></i>&nbsp;<span>Add more files</span></span>
                </div>
            </div>

			<div class="form-group">
				<div class="col-sm-12 text-right">
					<button type="submit" class="btn btn-skyblue">Add Comment</button>
				</div>
			</div>

		</form>

	</div>

</div>