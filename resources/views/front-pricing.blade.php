@extends('layouts.front')

@section('title')
Pricing & Plans
@endsection

@section('content')
	
	<div class="content-pricing">
	
		<section class="section-image">
		
			<div class="banner-container">
				<img src="{{ asset('images/pricing-bg.jpg') }}" class="img-responsive pricing-bg">
				
				<div class="text-container">
					<h1 class="title text-center">Get started now, simple and flexible</h1>
					<div class="text text-center">Try our FREE plan. No risk. No fees. No credit card required.</div>
				</div>
			</div>
		
		</section><!-- End .section-image -->
		
		<section class="plans">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Starter</h3>
								<div class="price-content">
									<span class="currency"><i class="fa fa-usd"></i></span>
									<span class="price">0</span>
									<span class="price-description">Free to use, and sign up is required.</span>
								</div>
							</div>
							<div class="panel-body list-items">
								<div class="list-title">All of these features</div>
								<ul>
									<li><i class="fa fa-check-circle-o"></i><span class="text">Up to 5 users</span></li>
									<li><i class="fa fa-check-circle-o"></i><span class="text">1 GB of storage</span></li>
									<li><i class="fa fa-check-circle-o"></i><span class="text">Add unlimited projects and tasks</span></li>
								</ul>
								<div class="sign-up">
									<a href="#" class="btn btn-skyblue">Start Free</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Basic</h3>
								<div class="price-content">
									<span class="currency"><i class="fa fa-usd"></i>
									</span>
									<span class="price">29</span>
									<span class="price-description">Per month billed annually or $34 month-to-month.</span>
								</div>
							</div>
							<div class="panel-body list-items">
								<div class="list-title">All Starter features, plus</div>
								<ul>
									<li><i class="fa fa-check-circle-o"></i><span class="text">Up to 20 users</span></li>
									<li><i class="fa fa-check-circle-o"></i><span class="text">5 GB of storage</span></li>
									<li><i class="fa fa-check-circle-o"></i><span class="text">24/7 email support</span></li>
								</ul>
								<div class="sign-up">
									<a href="#" class="btn btn-skyblue">Start Free</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- End .container-fluid -->
		</section>
		
		<section class="faq-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 content">
						<h2 class="heading text-center">Frequently Asked Questions</h2>
						<ul>
							<li>
								<div class="title">Is the free starter plan really free?</div>
								<div class="faq-description" style="display:none">Yes. It's completely free; no credit card required.</div>
								<span class="accordion-arrow"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up" style="display:none"></i></span>
							</li>
							<li>
								<div class="title">Can I change my plan?</div>
								<div class="faq-description" style="display:none">
								Yes. You can upgrade, downgrade, or cancel your plan any time you want. 
								Simply drop us an email and describe what you require.
								</div>
								<span class="accordion-arrow"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up" style="display:none"></i></span>
							</li>
							<li>
								<div class="title">Is the product right for me?</div>
								<div class="faq-description" style="display:none">
								It depends on your internal project management process. 
								As we worked in <strong>web</strong> and <strong>media</strong> agencies, we understand what would happen during the whole project process from sales to maintenance.
								Our tool aims to put your daily project tasks organized.
								</div>
								<span class="accordion-arrow"><i class="fa fa-angle-down"></i><i class="fa fa-angle-up" style="display:none"></i></span>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- End .container -->
		</section>
	
	</div><!-- End .content-pricing -->


@endsection