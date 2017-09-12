@extends('layouts.back')

@section('title')
Edit Permission
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Edit permission</div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('permissions/'.$permission->id) }}" method="POST">

				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="form-group required">
					<label for="name" class="col-sm-2 control-label">Permission Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: (isset($permission) ? $permission->name : '') }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Label</label>
					<div class="col-sm-5">
						<input type="text" name="label" class="form-control" id="label" required="true" value="{{ old('label') ?: (isset($permission) ? $permission->label : '') }}">
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