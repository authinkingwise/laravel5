@extends('layouts.back')

@section('title')
Ticket Details
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Ticket Details</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('tickets') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Tickets</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="page-heading panel-heading">{{ $ticket->title }}</div>

				<div class="panel-body">

					<div class="row">
						<div class="col-lg-10 col-md-10 col-sm-10">
							<dl class="dl-horizontal">
								<dt>Description:</dt>
								<dd>{!! $ticket->description !!}</dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Status:</dt>
								<dd><span class="status-{{ $ticket->status->short_name }}"><strong>{{ $ticket->status->name }}</strong></span></dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Assigned to:</dt>
								<dd>
									@isset($ticket->user)
										{{ $ticket->user->name }}
									@endisset
								</dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Account:</dt>
								<dd>@isset($ticket->account)
									<a href="{{ url('accounts/'.$ticket->account->id) }}">{{ $ticket->account->name }}</a>
									@endisset
								</dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Priority:</dt>
								<dd>
									@isset($ticket->priority)
										{{ $ticket->priority->name }}
									@endisset
								</dd>
							</dl>

							@isset($ticket->estimated_time)
								<dl class="dl-horizontal">
									<dt>Estimated Hours:</dt>
									<dd>{{ $ticket->estimated_time }}</dd>
								</dl>
							@endisset

							<dl class="dl-horizontal">
								<dt>Created by:</dt>
								<dd>{{ $ticket->creator->name }}&nbsp;&nbsp;<small>{{ $ticket->created_at }}</small></dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Last Updated by:</dt>
								<dd>{{ $ticket->lastUpdateUser->name }}&nbsp;&nbsp;<small>{{ $ticket->updated_at }}</small></dd>
							</dl>

							@if($time_spent > 0)
								<dl class="dl-horizontal">
									<dt>Hours spent:</dt>
									<dd>{{ $time_spent }}</dd>
								</dl>
							@endif
						</div>

						@can('edit-ticket')
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="pull-right">
								<a href="{{ url('tickets/' . $ticket->id . '/edit') }}" class="btn btn-skyblue btn-sm btn-block">
									<i class="fa fa-edit"></i>
									<span>Edit</span>
								</a>
							</div>
						</div>
						@endcan
					</div>

				</div>

			</div><!-- End .panel -->

			@if(count($comments))

				@include('ticket_comment.index')

			@endif

			@can('create-comment')
			
				@include('ticket_comment.create')

			@endcan

		</div>

	</div>

@endsection