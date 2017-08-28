@extends('layouts.front')

@section('title')
Home
@endsection

@section('content')
	
	<div class="jumbotron">
		<div class="container">
			<h1>Designed for Web and Media Agencies</h1>
			<p>An easy way for team members to track their work and get results</p>
			<p>{{ config('app.name', 'Agency Bucket') }}, gives you many online communication tools to motivate the client to move through the sales pipeline.</p>
			<p><a href="{{ url('/sign-up') }}" class="btn btn-primary btn-lg">Try it free</a></p>
		</div>
	</div>

	<div class="block-marketing block-sign">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<form class="form-signup" method="POST" action="#">
					{{ csrf_field() }}
					<h2>Get More Done</h2>
					<p class="text">
						<i class="fa fa-hourglass-start" aria-hidden="true"></i><span>Get Started Free with No Risk</span>
					</p>
					<div class="form-group">
						<label for="name" class="sr-only">Company</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Company Name" value="{{ old('name') }}" required>
					</div>
					<div class="form-group">
						<label for="email" class="sr-only">Email address</label>
						<input type="email" id="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required>
					</div>
					<div class="form-group">
						<label for="password" class="sr-only">Password</label>
						<input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-skyblue btn-block" type="submit">Sign up</button>
					</div>
				</form>
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="play-video">
					<div class="open_video_btn">
						<img src="{{ asset('images/product-video-opt.png') }}" class="img-responsive img-rounded">
					</div>
				</div>
				<div class="video_overlay transp_000_95" style="display:none;">
                    <div id="video_player_div">
                        <div id="video_player"></div>
                    </div>
                </div>
	
			</div>
		</div>
	</div>
	</div>

	<div class="block-features block-marketing">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<img src="{{ asset('images/home-customizable.png') }}" class="img-responsive img-rounded">
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="text-container">
						<h2 class="title">Track Projects from Start to Finish</h2>
						<p class="text">Responsibilities and next steps are clear, so you can shoot for the moon—and get there.</p>
						<a href="#" class="btn btn-lg btn-skyblue">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="block-industry block-marketing">
		<div class="container">
			<h2 class="title text-center">Fit with Your Industry</h2>
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="image-container text-center">
						<i class="fa fa-wordpress fa-6" aria-hidden="true"></i>
					</div>
					<div class="text-container">
						<div class="text text-center">Web Agency</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="image-container text-center">
						<i class="fa fa-youtube-play fa-6" aria-hidden="true"></i>
					</div>
					<div class="text-container">
						<div class="text text-center">Media Advertising</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="image-container text-center">
						<i class="fa fa-eyedropper fa-6" aria-hidden="true"></i>
					</div>
					<div class="text-container">
						<div class="text text-center">Design Consulting</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="image-container text-center">
						<i class="fa fa-camera-retro fa-6" aria-hidden="true"></i>
					</div>
					<div class="text-container">
						<div class="text text-center">Marketing Agency</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="block-marketing block-trial">
		<div class="container">
			<h2 class="title text-center">Start a Free Trial</h2>
			<div class="text-container">
				<div class="text text-center">Get started today, and set up a free trail with no contact and no credit card.</div>
			</div>
			<div class="button-container text-center">
				<a href="#" class="btn btn-lg btn-skyblue">Learn More</a>
			</div>
		</div>
	</div>

@endsection