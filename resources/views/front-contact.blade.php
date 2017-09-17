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
		                    <form name="sentMessage" id="contactForm" novalidate>
		                        <div class="row">
		                            <div class="col-md-6">
		                                <div class="form-group">
		                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                                <div class="form-group">
		                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                                <div class="form-group">
		                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                            </div>
		                            <div class="col-md-6">
		                                <div class="form-group">
		                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
		                                    <p class="help-block text-danger"></p>
		                                </div>
		                            </div>
		                            <div class="clearfix"></div>
		                            <div class="col-md-12 text-center">
		                                <div id="success"></div>
		                                <button type="submit" class="btn-primary btn-xl">Send Message</button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </section>
        <!-- Scripts -->
        @section('javascript')
            <script type="text/javascript" src="{{ asset('/js/contact_me.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/jqBootstrapValidation.js') }}"></script>           
        @show		    
	</div>

@endsection	