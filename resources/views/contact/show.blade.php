@extends('layouts.back')

@section('title')
Contact Details
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Contact Details</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('contacts') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-list"></i><span>All Contacts</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="page-heading panel-heading">{{ $contact->firstname }}&nbsp;{{ $contact->lastname }}</div>

				<div class="panel-body">

					<div class="row">
						<div class="col-lg-10 col-md-10 col-sm-10">
								<dl class="dl-horizontal">
									<dt>Name:</dt>
									<dd>{{ $contact->firstname }}&nbsp;{{ $contact->lastname }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Email:</dt>
									<dd>{{ $contact->email }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Mobile:</dt>
									<dd>{{ $contact->mobile }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Account:</dt>
									<dd>@isset($contact->account)
										<a href="{{ url('accounts/'.$contact->account->id) }}">{{ $contact->account->name }}</a>
										@endisset
									</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Created:</dt>
									<dd>{{ $contact->created_at }}</dd>
								</dl>

								<dl class="dl-horizontal">
									<dt>Last Updated:</dt>
									<dd>{{ $contact->updated_at }}</dd>
								</dl>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<div class="pull-right">
								<a href="{{ url('contacts/' . $contact->id . '/edit') }}" class="btn btn-skyblue btn-sm btn-block">
									<i class="fa fa-edit"></i>
									<span>Edit</span>
								</a>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>

@endsection