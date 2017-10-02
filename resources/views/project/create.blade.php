@extends('layouts.back')

@section('title')
Create Project
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">
            <span>Add a new project</span>
            <a href="{{ url('projects') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Projects</span></a>
        </div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('projects') }}" method="POST" id="projectform">

				{{ csrf_field() }}

				<div class="form-group required{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-sm-2 control-label">Project Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: '' }}">

						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" id="description" rows="5" name="projectform">{{ old('description') ?: '' }}</textarea>
					</div>
				</div>

				<div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-5">
                        <select name="status" class="form-control" id="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group required">
                    <label for="user_id" class="col-sm-2 control-label">Assign to</label>
                    <div class="col-sm-5">
                        <select name="user_id" class="form-control" id="user_id">
                        	<option selected value="{{ old('user_id') ?: '' }}"> -- Select a User -- </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group required">
                    <label for="account_id" class="col-sm-2 control-label">Account</label>
                    <div class="col-sm-5">
                        <select name="account_id" class="form-control" id="account_id" required="true">
                        	<option selected value> -- Select a Account -- </option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" @if(old('account_id') == $account->id) selected @endif>
                                    {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="help-block">If you can not find the account in the drop-down list, please <a href="{{ url('accounts/create') }}">create</a> a new account.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="visible" class="col-sm-2 control-label">Visible to everyone</label>
                    <div class="col-sm-5">
                    	<p class="form-control-static">
							<label class="radio-inline"><input type="radio" name="visible" value="1" id="visible_1" checked="checked">Yes</label>
							<label class="radio-inline"><input type="radio" name="visible" value="0" id="visible_0">No</label>
						</p>
                    </div>
                </div>

                <div class="form-group visible_to_users_group" 
                	@if(old('visible') != null)
	                	@if(old('visible') == 1) 
	                		style="display:none" 
	                	@elseif (old('visible') == 0)
	                		style="display:block" 
	                	@endif
	                @else
	                	style="display:none;"
                	@endif>
					<label for="allowed_users" class="col-sm-2 control-label">Visible to users</label>
					<div class="col-sm-5">
						<select name="allowed_users[]" class="form-control" id="allowed_users" multiple>
							@foreach($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
						<p class="help-block">Press "Ctrl" on keyboard to select multiple users.</p>
					</div>
				</div>

                <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-skyblue">Add Project</button>
					</div>
				</div>

			</form>

		</div>

	</div><!-- End .panel -->

@endsection