@extends('layouts.back')

@section('title')
Contacts
@endsection

@section('content')

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="page-heading">Contacts{{ isset($account) ? ' - ' . $account->name : '' }}&nbsp;<span class="badge">{{ $contacts->count() }}</span></div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<a href="{{ url('contacts/create') }}" class="btn btn-skyblue btn-sm pull-right"><i class="fa fa-plus"></i><span>Add Contact</span></a>
		</div>

	</div>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12">

			@include('layouts.message')

			<div class="panel panel-default">

				<div class="panel-body">

					@if(count($contacts))
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Contact</th>
									<th>Email</th>
									<th>Account</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($contacts as $contact)
									<tr>
										<td>
											<div><a href="{{ url('contacts/'.$contact->id) }}">{{ $contact->firstname }}&nbsp;{{ $contact->lastname }}</a></div>
										</td>
										<td>
											<div>{{ $contact->email }}</div>
										</td>
										<td>
											<div>
												@isset($contact->account)
													<a href="{{ url('accounts/'.$contact->account->id) }}">{{ $contact->account->name }}</a>
												@endisset
											</div>
										</td>
										<td class="actions">
											@can('edit-contact')
												<a href="{{ url('contacts/'.$contact->id.'/edit') }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i><span class="hidden-xs">Edit</span></a>
											@endcan

											@can('destroy-contact')
												<form action="{{ url('contacts/'.$contact->id) }}" method="POST" class="form-inline delete-action">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="DELETE">
													<div class="form-group">
														<button type="submit" class="btn btn-default btn-sm" onclick="return confirm('Sure to delete?')"><i class="fa fa-trash"></i><span class="hidden-xs">Delete</span></button>
													</div>
												</form>
											@endcan
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>There is no contact yet.</p>
					@endif

				</div>

			</div>

		</div>

	</div><!-- End .row -->

	<div class="clearfix">
		<ul class="pull-right">
			@isset($account)
				{{ $contacts->appends($_REQUEST)->links() }}
			@else
				{{ $contacts->links() }}
			@endisset
		</ul>
	</div>

@endsection