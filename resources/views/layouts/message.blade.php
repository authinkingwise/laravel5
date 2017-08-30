@if (Session::has('success'))
	<!-- success alert -->
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Great!</strong>&nbsp;{{ Session::get('success') }}
	</div>
@endif

@if (Session::has('error'))
	<!-- error alert -->
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Oh something wrong!</strong>&nbsp;{{ Session::get('error') }}
	</div>
@endif