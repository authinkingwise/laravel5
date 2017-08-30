@extends('layouts.front')

@section('title')
Sign Up
@endsection

@section('content')

	<div class="content-register">

		<section class="section-register">

			<div class="container">

    			<div class="row">

    				<div class="col-md-6 col-md-offset-3">

    					<div class="panel panel-default">

                			<div class="panel-heading text-center"><h2 class="title">Start a Free Trial of Agency Bucket</h2></div>

                			<div class="panel-body">

		    					<form class="form-horizontal" method="POST" action="{{ url('site/create') }}">
		                        	{{ csrf_field() }}

			                        <div class="form-group">
			                            <label for="name" class="col-md-4 control-label">Company</label>

			                            <div class="col-md-6">
			                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
			                            </div>
			                        </div>

			                        <div class="form-group">
			                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

			                            <div class="col-md-6">
			                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
			                            </div>
			                        </div>

			                        <div class="form-group">
			                            <label for="password" class="col-md-4 control-label">Password</label>

			                            <div class="col-md-6">
			                                <input id="password" type="password" class="form-control" name="password" required autofocus>
			                            </div>
			                        </div>

			                        <div class="form-group">
			                            <div class="col-md-6 col-md-offset-4">
			                                <button type="submit" class="btn btn-skyblue btn-block">Register</button>
			                            </div>
			                        </div>
			                    </form>

			                </div>

			            </div>

    				</div>

    			</div>

    		</div>

		</section><!-- End .section-register -->

	</div>

@endsection