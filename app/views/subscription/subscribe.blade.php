@extends('layouts.login')

@section('title')
Subscription
@stop

@section('content')
	<legend><h3>You are not yet subscribed to this application.</a></h3></legend>
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
	<a href="{{ url('start_payment') }}" class="btn btn-primary btn-lg btn-block">Subscribe now!</a>
	<a href="{{ url('logout') }}" class="btn btn-default btn-block">Logout</a>
@stop
