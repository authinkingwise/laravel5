@extends('layouts.front')

@section('title')
Features
@endsection

@section('content')

	<div class="content-features">

		<section class="section-image">
		
			<div class="banner-container">
				<img src="{{ asset('images/agency-bg.jpg') }}" class="img-responsive agency-bg">
				
				<div class="text-container">
					<h1 class="title text-center">Solutions Built for Your Agency Workforce Challenges</h1>
					<div class="text text-center">Project management & collaboration platform. Optimize the workflow for your agency team.</div>
				</div>
			</div>
		
		</section><!-- End .section-image -->

		<section class="section-features">

			<div class="block-features first">

				<div class="container">

					<div class="row">
						<div class="col-lg-6 col-md-6">
							<img src="{{ asset('images/devices-screenshot.png') }}" class="img-responsive">
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="text-container">
								<h2 class="title">Know Your Project from Start to Finish</h2>
								<p class="text">A digital workplace to collaborate in real time</p>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="block-features second">

				<div class="container">

					<div class="row">
						<div class="col-lg-6 col-md-6">
							<img src="{{ asset('images/devices-screenshot.png') }}" class="img-responsive">
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="text-container">
								<h2 class="title">Improve productivity</h2>
								<p class="text">Provide a clear path for members to get work done togeter.</p>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="block-features third">

				<div class="container">

					<div class="row">
						<div class="col-lg-6 col-md-6">
							<img src="{{ asset('images/devices-screenshot.png') }}" class="img-responsive">
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="text-container">
								<h2 class="title">Easily track progress</h2>
								<p class="text">Share feedback and present update.</p>
							</div>
						</div>
					</div>

				</div>

			</div>
			
		</section><!-- End .section-features -->

	</div>

@endsection