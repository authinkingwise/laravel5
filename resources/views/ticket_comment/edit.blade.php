@extends('layouts.back')

@section('title')
Edit Comment
@endsection

@section('content')

<div class="content">
		
	<div class="container-fluid">

		<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12">

				<div class="panel panel-default" id="edit_comment">

					<div class="page-heading panel-heading">
						<span>Edit comment</span>&nbsp;-&nbsp;<span>{{ $comment->ticket->title }}</span>
						<a href="{{ url('tickets/'.$comment->ticket->id) }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-angle-left"></i><span>Back</span></a>
					</div>

					<div class="panel-body">

						<form class="form-horizontal" action="{{ url('comments/'.$comment->id) }}" method="POST" id="commentform" enctype="multipart/form-data">

							{{ csrf_field() }}

							<input type="hidden" name="_method" value="PUT">

							<input type="hidden" name="ticket_id" value="{{ $comment->ticket->id }}">

							<div class="row form-group">

								<div class="col-sm-3">
									<label for="status_id"><strong>Status</strong></label>
									<select name="status_id" class="form-control" id="status_id">
					                    @foreach($statuses as $status)
					                        <option value="{{ $status->id }}" 
					                        	@if(old('status_id') == $status->id) 
					                        		selected
					                        	@else
					                        		@isset($comment->ticket->status)
					                        			@if($status->id == $comment->ticket->status->id)
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
					                        		@isset($comment->user)
				                                        @if($user->id == $comment->user->id)
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
					                        		@isset($comment->ticket->priority)
				                                        @if($priority->id == $comment->ticket->priority->id)
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
									<input type="text" name="time" class="form-control" id="time" value="{{ old('time') ?: (isset($comment->time) ? $comment->time : '') }}">

									@if ($errors->has('time'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('time') }}</strong>
				                        </span>
				                    @endif
								</div>

							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<textarea name="comment_description" class="form-control" id="comment_description" rows="3" form="commentform">{!! old('description') ?: (isset($comment) ? $comment->description : '') !!}</textarea>
								</div>
							</div>

							<div class="form-group">
				                <label for="files" class="col-sm-2 control-label">Attachment</label>
				                <div class="col-sm-4">

				                	@if($comment->commentFiles->count() > 0)
			                            @foreach($comment->commentFiles as $attachment)
			                                <div class="form-control-static">
			                                    <a href="{{ url('ticketfiles/' . $attachment->id) }}">{{ $attachment->file }}</a>&nbsp;
			                                    
			                                    <button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')" form="{{ $attachment->id }}"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
			                                </div>
			                            @endforeach
			                        @endif

				                    <input type="file" name="files[]" class="form-control">
				                    <span class="btn btn-warning btn-sm" id="add-file"><i class="fa fa fa-plus-circle"></i>&nbsp;<span>Add more files</span></span>
				                </div>
				            </div>

							<div class="form-group">
								<div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-skyblue">Update Comment</button>
								</div>
							</div>

						</form>

						@if($comment->commentFiles->count() > 0)
			                @foreach($comment->commentFiles as $attachment)
			                    <form action="{{ url('commentfiles/'.$attachment->id) }}" method="POST" class="form-inline delete-action" id="{{ $attachment->id }}">
			                    	<input type="hidden" name="_token" value="{{ csrf_token() }}" form="{{ $attachment->id }}">
			                        <input type="hidden" name="_method" value="DELETE" form="{{ $attachment->id }}">
			                    </form>
			                @endforeach
			            @endif

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@endsection