@extends('layouts.subscribe')

@section('title')
Subscription
@stop

@section('content')
	<legend><h3>You are required to pay to continue creating a report.</a></h3></legend>
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
	<div class="subscribe" style="margin: 30px 0px 0px; text-align: center; width: 100%;">
		<a style="font-size: 18px; float: center;" class="text-center col-xs-6 btn btn-primary" href="{{ url('start_payment/' . $timestamp . '/' . $client_id) }}"> Pay now! </a>
	</div>
	<div class="subscribe" style="margin: 20px 0px 30px; text-align: center; width: 100%; float: left;">
		<a class="btn btn-primary" href="{{ url('cancel_payment/' . $timestamp . '/' . $client_id) }}"> Go Back </a>
	</div>
@stop
