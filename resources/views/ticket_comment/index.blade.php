<div class="panel panel-default">

	<div class="page-heading panel-heading">
		<span>Comments</span>
		@can('create-comment')
			<a href="#add_comment" class="btn btn-skyblue btn-sm pull-right">
				<i class="fa fa-plus"></i>
				<span>Add Comment</span>
			</a>
		@endcan
	</div>

	<div class="panel-body">

		<div class="row comment-list">
			
			<div class="col-lg-12 col-md-12 col-sm-12">
				@foreach($comments as $comment)
					<dl class="dl-horizontal">
						<dt>{{ $comment->user->name }}:</dt>
						<dd class="item">
							<div>{!! $comment->description !!}</div>
							<div>
								@if($comment->commentFiles->count() > 0)
									<span>Attachment:</span>
									@foreach($comment->commentFiles as $attachment)
										<a href="{{ url('commentfiles/' . $attachment->id) }}">{{ $attachment->file }}</a>&nbsp;
									@endforeach
								@endif
							</div>
							<div><small>@isset($comment->ticketActivity) {!! $comment->ticketActivity->text !!}&nbsp; @endisset{{ $comment->updated_at }}</small></div>
							@isset($comment->time)
								<div><small>Hours spent: {{ $comment->time }} hours</small></div>
							@endisset
							@can('edit-comment', $comment)
								<div><a href="{{ url('comments/'.$comment->id.'/edit') }}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a></div>
							@endcan
						</dd>
					</dl>
				@endforeach
			</div>

		</div>

	</div>

</div>