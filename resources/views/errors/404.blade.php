@extends('layouts.back')

@section('title')
404 Error
@endsection

@section('content')

	<div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-md-12 col-sm-12">
	            <div class="panel panel-default">
		            <div class="panel-heading page-heading">404 Page Not Found</div>
		            <div class="panel-body">
		                <h4>Sorry, the page you are looking for could not be found..</h4>
		                <br />
		                <a href="{{ url()->previous() }}" class="btn btn-skyblue btn-sm"><i class="fa fa-angle-left"></i><span>Go Back</span></a>
		            </div>
	            </div>
	        </div>
    	</div>
	</div>

@endsection