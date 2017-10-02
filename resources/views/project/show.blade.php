@extends('layouts.back')

@section('title')
Project
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Project - {{ $project->name }}</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('projects') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Projects</span></a>
		</div>

	</div>

	<div class="row project-details">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-heading">
					
					@can('edit-project')
						<button class="btn btn-default btn-sm" title="Edit project" data-toggle="modal" data-target="#edit-project-modal">
							<i class="fa fa-folder-open"></i>
							<span>Edit</span>
						</button>
					@endcan
					@can('create-task')
						<button class="btn btn-primary btn-sm" title="Add a new task to this project" data-toggle="modal" data-target="#add-modal">
							<i class="fa fa fa-plus-circle"></i>
							<span>Create Task</span>
						</button>
					@endcan

				</div>

				<div class="panel-body">

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Status:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@if($project->status)
								Active
							@else
								Inactive
							@endif
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Account (client):</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->account)
								<a href="{{ url('account/' . $project->account->id) }}">{{ $project->account->name }}</a>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Assign to (Manager):</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->user)
								{{ $project->user->name }}
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Created by:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->creator)
								<span>{{ $project->creator->name }}</span>&nbsp;&nbsp;<small>{{ $project->created_at }}</small>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Last Updated by:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@isset($project->lastUpdateUser)
								<span>{{ $project->lastUpdateUser->name }}</span>&nbsp;&nbsp;<small>{{ $project->updated_at }}</small>
							@endisset
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Description:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<div class="text-desc">{!! $project->description !!}</div>
						</div>
					</dl>

					<dl class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<div class="pull-right">
								<label>Visible:</label>
							</div>
						</div>

						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							@if($project->visible)
								everyone
							@elseif($allowed_users != null)
								@if(count($allowed_users) == 1)
									@foreach($allowed_users as $user)
										{{ $user->name }}
									@endforeach
								@else
									@foreach($allowed_users as $index => $user)
										@if ($loop->last)
											{{ $user->name . '.' }}
										@else
											{{ $user->name . ', ' }}
										@endif
									@endforeach
								@endif
							@endif
						</div>
					</dl>

				</div>

			</div>

		</div>

	</div>

	<div class="modal fade" id="edit-project-modal" tabindex="-1" role="dialog" aria-labelledby="edit-project-modal-label">
		@include('project.edit')
	</div><!-- End #edit-project-modal -->

@endsection