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
		            	<div class="panel-heading page-heading">URL Error</div>
		                <div class="panel-body">
		                	<h4>The page has error or the content does not exist. Please check the url.</h4>
		                	<br />
		                	<a href="{{ url()->previous() }}" class="btn btn-skyblue btn-sm"><i class="fa fa-angle-left"></i><span>Go Back</span></a>
		                </div>
	            	@else
		                <div class="panel-heading page-heading">Access denied</div>
		                <div class="panel-body">
		                	<h4>Your account does not allow you to operate this action. Please contact administrator.</h4>
		                	<br />
		                	@isset($errorProjectVisible)
		                		<h4>Not visible to this project.</h4>
		                	@endisset
		                	<a href="{{ url()->previous() }}" class="btn btn-skyblue btn-sm"><i class="fa fa-angle-left"></i><span>Go Back</span></a>
		                </div>
	                @endisset
	            </div>
	        </div>
    	</div>
	</div>

@endsection