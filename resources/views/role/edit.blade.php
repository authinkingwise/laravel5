@extends('layouts.back')

@section('title')
Edit Role
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Edit role<a href="{{ url('roles') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Roles</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('roles/'.$role->id) }}" method="POST">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="form-group required">
					<label for="name" class="col-sm-2 control-label">Role Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: (isset($role) ? $role->name : '') }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Label</label>
					<div class="col-sm-5">
						<input type="text" name="label" class="form-control" id="label" value="{{ old('label') ?: (isset($role) ? $role->label : '') }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Permissions</label>
					<div class="col-sm-8">
						@foreach($allPermissions as $permission)

							@foreach($controllers as $controllerName)
								@if(str_contains($permission->name, $controllerName))
									<label class="checkbox-inline role-permission">
										<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}" @if(in_array($permission->id, $currentPermissionsId)) checked @endif><small>{{ $permission->label }}</small>
									</label>
								@endif
							@endforeach
							@if($loop->iteration % 4 == 0) <br /> @endif
							
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-skyblue">Update</button>
					</div>
				</div>

			</form>

		</div>

	</div>

@endsection