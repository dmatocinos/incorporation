@extends('layouts.login')

@section('title')
Subscription
@stop

@section('content')
	<legend><h3>You are required to pay to continue creating a report.</a></h3></legend>
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
	<a href="{{ url('start_payment') }}" class="btn btn-primary btn-lg btn-block">Pay now!</a>
	<a href="{{ url('cancel_payment') }}" class="btn btn-default btn-block">Cancel</a>
@stop
