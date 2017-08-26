@extends('layouts.front')

@section('title')
Contact Us
@endsection

@section('content')

	<div class="content-contact">

		<section class="section-form">
			
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">

						<form class="form-horizontal" action="#" method="POST">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-5">
									<input type="text" name="name" class="form-control" id="name">
								</div>
							</div>
							<div class="form-group required">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-5">
									<input type="text" name="email" class="form-control" id="email" required="true">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-5">
									<input type="text" name="phone" class="form-control" id="phone">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-5">
									<textarea name="description" class="form-control" id="description" rows="5"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-skyblue">Send Message</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>

		</section>

	</div>

@endsection