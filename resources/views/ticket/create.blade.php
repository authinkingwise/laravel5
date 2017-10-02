@extends('layouts.back')

@section('title')
Create Ticket
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">
            <span>Add a new ticket</span>@isset($related_account) - <span>{{ $related_account->name }}</span> @endisset
            <a href="{{ url('mytickets') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>My Tickets</span></a>
        </div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('tickets') }}" method="POST" id="ticketform">

				{{ csrf_field() }}

				<div class="form-group required{{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title" class="col-sm-2 control-label">Ticket Title</label>
					<div class="col-sm-5">
						<input type="text" name="title" class="form-control" id="title" required="true" value="{{ old('title') ?: '' }}">

						@if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-5">
						<textarea name="description" class="form-control" id="description" rows="5" name="ticketform">{{ old('description') ?: '' }}</textarea>
					</div>
				</div>

				<div class="form-group">
                    <label for="status_id" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-5">
                        <select name="status_id" class="form-control" id="status_id">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" @if(old('status_id') == $status->id) selected @endif>{{ $status->name }}</option>
                            @endforeach
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
                                <option value="{{ $account->id }}" 
                                    @isset($related_account) 
                                        @if($related_account->id == $account->id) selected @endif 
                                    @else
                                        @if(old('account_id') == $account->id) selected @endif
                                    @endisset>{{ $account->name }}</option>
                            @endforeach
                        </select>
                        <p class="help-block">If you can not find the account in the drop-down list, please <a href="{{ url('accounts/create') }}">create</a> a new account.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="priority_id" class="col-sm-2 control-label">Priority</label>
                    <div class="col-sm-5">
                        <select name="priority_id" class="form-control" id="priority_id">
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}" @if(old('priority_id') == $priority->id) selected @endif>{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('estimated_time') ? ' has-error' : '' }}">
					<label for="estimated_time" class="col-sm-2 control-label">Estimated Hours</label>
					<div class="col-sm-3">
						<input type="text" name="estimated_time" class="form-control" id="estimated_time" value="{{ old('estimated_time') ?: '' }}">

						@if ($errors->has('estimated_time'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estimated_time') }}</strong>
                            </span>
                        @endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-skyblue">Add</button>
					</div>
				</div>

			</form>

		</div>

	</div>

@endsection