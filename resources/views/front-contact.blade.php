@extends('layouts.front')

@section('title')
	Contact Us
@endsection

@section('content')
	<div class="content-contact">
		<!-- Contact Section -->
		<section id="contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<h2 class="section-heading">Contact Me</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form name="sentMessage" id="contactForm" method="POST" action="/contact">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
										<input type="text" class="form-control" placeholder="Your Name *" id="name" name="name" required>
										@if ($errors->has('name'))
											<span class="help-block text-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                    			</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<input type="email" class="form-control" placeholder="Your Email *" id="email" name="email" required>
										@if ($errors->has('email'))
											<span class="help-block text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
										<input type="tel" class="form-control" placeholder="Your Phone *" id="phone"  name="phone" required>
										@if ($errors->has('phone'))
											<span class="help-block text-danger">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
										<textarea class="form-control" placeholder="Your Message *" id="message" name="message" required></textarea>
										@if ($errors->has('message'))
											<span class="help-block text-danger">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
										@endif
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-12 text-center" id="sendmessage" style="margin-bottom: 20px;">
									<div id="success"></div>
									@if ( $STATUS == 'SUCCESS')
										<div class='alert alert-success'>
												<span class="help-block text-danger">
                                                    <strong>Your message has been sent, thank you!</strong>
												</span>
										</div>
									@endif
									<button type="submit" class="btn btn-primary">Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- Scripts -->
	</div>
	@if( count($errors) > 0 )
		<div class="alert alert-danger">
			@foreach($errors -> all() as $error)
				<p>{{  $error  }}</p>
			@endforeach
		</div>
	@endif
@endsection