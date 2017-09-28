<div class="panel panel-default">

	<div class="page-heading panel-heading">Comments</div>

	<div class="panel-body">

		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10">
				@foreach($comments as $comment)
					<dl class="dl-horizontal">
						<dt>{{ $comment->user->name }}:</dt>
						<dd>
							<div>{!! $comment->description !!}</div>
							<div><small>@isset($comment->ticketActivity) {!! $comment->ticketActivity->text !!}&nbsp; @endisset{{ $comment->updated_at }}</small></div>
							@isset($comment->time)
								<div><small>Hours spent: {{ $comment->time }} hours</small></div>
							@endisset
						</dd>
					</dl>
				@endforeach
			</div>

			@can('create-comment')
				<div class="col-lg-2 col-md-2 col-sm-2">
					<div class="pull-right">
						<a href="#add_comment" class="btn btn-skyblue btn-sm btn-block">
							<i class="fa fa-plus"></i>
							<span>Add Comment</span>
						</a>
					</div>
				</div>
			@endcan

		</div>

	</div>

</div>