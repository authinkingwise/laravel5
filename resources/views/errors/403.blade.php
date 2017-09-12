@extends('layouts.back')

@section('title')
Permission Denied
@endsection

@section('content')

	<div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-md-12 col-sm-12">
	            <div class="panel panel-default">
	            	@isset($errorTenant)
		            	<div class="panel-heading page-heading">Page Error</div>
		                <div class="panel-body">
		                	<p>The page has error or the content does not exist. Please check the url.</p>
		                	<a href="{{ url()->previous() }}" class="btn btn-skyblue btn-sm"><i class="fa fa-angle-left"></i><span>Go Back</span></a>
		                </div>
	            	@else
		                <div class="panel-heading page-heading">Access denied</div>
		                <div class="panel-body">
		                	<p>Your account does not allow you to operate this action. Please contact administrator.</p>
		                	<a href="{{ url()->previous() }}" class="btn btn-skyblue btn-sm"><i class="fa fa-angle-left"></i><span>Go Back</span></a>
		                </div>
	                @endisset
	            </div>
	        </div>
    	</div>
	</div>

@endsection