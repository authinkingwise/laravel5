<div class="modal-dialog modal-lg" role="document">
	
	<div class="modal-content">

		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title">Edit project</h4>
		</div>

		<div class="modal-body">

			<form class="form-horizontal" action="{{ url('projects/' . $project->id) }}" method="POST" enctype="multipart/form-data" id="edit-project">
				
				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">
				
				<div class="form-group required">
					<label for="project_name_edit" class="col-sm-4 control-label">Project Title</label>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control" id="project_name_edit" value="{{ $project->name }}" required="true">
					</div>
				</div>
				<div class="form-group">
					<label for="project_status_edit" class="col-sm-4 control-label">Status</label>
					<div class="col-sm-8">
						<select name="status" class="form-control" id="project_status_edit">
							<option value="1" @if($project->status == 1) selected="selected" @endif>Active</option>
							<option value="0" @if($project->status == 0) selected="selected" @endif>Inactive</option>
						</select>
					</div>
				</div>
				<div class="form-group required">
					<label for="account" class="col-sm-4 control-label">Account</label>
					<div class="col-sm-8">
						<select name="account_id" class="form-control" id="account_id" required="true">
                        	<option value> -- Select a Account -- </option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" @if($project->account->id == $account->id) selected @endif>
                                    {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
					</div>
				</div>
				<div class="form-group required">
					<label for="project_user_id" class="col-sm-4 control-label">Assigned to</label>
					<div class="col-sm-8">
						<select name="user_id" class="form-control" id="project_user_id" required="true">
							<option disabled selected value> -- Select a user -- </option>
							@foreach($users as $user)
								<option value="{{ $user->id }}" @if($project->user_id == $user->id) selected="selected" @endif>{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="visible" class="col-sm-4 control-label">Visible to everyone</label>
						<div class="col-sm-8">
							<p class="form-control-static">
								<label class="radio-inline"><input type="radio" name="visible" value="1" id="visible_1" @if($project->visible == 1) checked="checked" @endif>Yes</label>
								<label class="radio-inline"><input type="radio" name="visible" value="0" id="visible_0" @if($project->visible == 0) checked="checked" @endif>No</label>
							</p>
						</div>
				</div>
				<div class="form-group visible_to_users_group" @if($project->visible == 1) style="display:none;" @endif>
					<label for="allowed_users" class="col-sm-4 control-label">Visible to users</label>
					<div class="col-sm-8">
						<select name="allowed_users[]" class="form-control" id="allowed_users" multiple="multiple">
							@foreach($users as $user)
								<option value="{{ $user->id }}" @isset($allowed_users_ids) @if(in_array($user->id, $allowed_users_ids)) selected="selected" @endif @endisset>{{ $user->name }}</option>
							@endforeach
						</select>
						<p class="help-block">Press "Ctrl" on keyboard to select multiple users. At least the project is visible to the project creator.</p>
					</div>
				</div>
				<div class="form-group required">
					<label for="project_description" class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" id="project_description" form="edit-project" rows="4">
							{!! $project->description !!}
						</textarea>
					</div>
				</div>
				<div class="form-group">
                    <label for="files" class="col-sm-4 control-label">Attachment</label>
                    <div class="col-sm-8">
                        @if($project->projectFiles->count() > 0)
                            @foreach($project->projectFiles as $attachment)
                                <div class="form-control-static">
                                    <a href="{{ url('projectfiles/' . $attachment->id) }}">{{ $attachment->file }}</a>&nbsp;
                                    <button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')" form="{{ $attachment->id }}"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
                                </div>
                            @endforeach
                        @endif
                        <input type="file" name="files[]" class="form-control">
                        <span class="btn btn-warning btn-sm pull-right" id="add-file"><i class="fa fa fa-plus-circle"></i>&nbsp;<span>Add more files</span></span>
                    </div>
                </div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10 text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			
			</form>

			@if($project->projectFiles->count() > 0)
                @foreach($project->projectFiles as $attachment)
                    <form action="{{ url('projectfiles/'.$attachment->id) }}" method="POST" class="form-inline delete-action" id="{{ $attachment->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" form="{{ $attachment->id }}">
                        <input type="hidden" name="_method" value="DELETE" form="{{ $attachment->id }}">
                    </form>
                @endforeach
            @endif

		</div><!-- /.modal-body -->
	
	</div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->