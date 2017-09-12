@extends('layouts.back')

@section('title')
Add Permission
@endsection

@section('content')

	<div class="panel panel-default">

		<div class="page-heading panel-heading">Add a new permission<a href="{{ url('permissions') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Permissions</span></a></div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('permissions') }}" method="POST">

				{{ csrf_field() }}

				<div class="form-group required">
					<label for="name" class="col-sm-2 control-label">Permission Name</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control" id="name" required="true" value="{{ old('name') ?: '' }}">
					</div>
				</div>

				<div class="form-group">
					<label for="label" class="col-sm-2 control-label">Label</label>
					<div class="col-sm-5">
						<input type="text" name="label" class="form-control" id="label" required="true" value="{{ old('label') ?: '' }}">
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