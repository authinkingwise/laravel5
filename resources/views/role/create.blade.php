@extends('layouts.back')

@section('title')
Add Role
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Add a new role<a href="{{ url('roles') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Roles</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('roles') }}" method="POST">

				{{ csrf_field() }}

				<div class="form-group required">
					<label for="name" class="col-sm-2 control-label">Role Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: '' }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Label</label>
					<div class="col-sm-5">
						<input type="text" name="label" class="form-control" id="label" value="{{ old('label') ?: '' }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Permissions</label>
					<div class="col-sm-8">
						@foreach($permissions as $permission)

							{{--
							@if(str_contains($permission->name, 'account'))
								<label class="checkbox-inline role-permission">
										<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'contact'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'ticket'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'project'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'task'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'user'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif

							@if(str_contains($permission->name, 'role'))
								<label class="checkbox-inline role-permission">
									<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
								</label>
								@if($loop->iteration % 4 == 0) <br /> @endif
							@endif
							--}}

							@foreach($controllers as $controllerName)
								@if(str_contains($permission->name, $controllerName))
									<label class="checkbox-inline role-permission">
										<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}"><small>{{ $permission->label }}</small>
									</label>
								@endif
							@endforeach
							@if($loop->iteration % 4 == 0) <br /> @endif
							
						@endforeach
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