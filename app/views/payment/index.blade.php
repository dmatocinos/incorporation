@extends('layouts.subscribe')

@section('Title')
Payment
@stop

@section('content')
	<legend><h3>You are required to pay to continue creating this report.</a></h3></legend>
	<div class="form-group" style="margin: 20px;">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
    {{ Form::open(['id' => 'payment-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
    <input type="hidden" name="timestamp" value="{{ $timestamp }}"/>
    <input type="hidden" name="email" value="{{ $email }}"/>

    <div class="alert alert-danger" style="display:none"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Card Number:</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" data-stripe="number">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">CVC (Security Code)</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" data-stripe="cvc">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Expiration Date</label>
        <div class="col-sm-6">
            {{ Form::selectMonth(null, '', array('class' => 'form-control', 'data-stripe' => 'exp-month', 'style' => 'margin-bottom: 5px;')) }}
            {{ Form::selectYear(null, date('Y'), date('Y') + 10, null, array('class' => 'form-control', 'data-stripe' => 'exp-year')) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6" style="text-align: left;">
            <input type="submit" class="btn btn-primary" value="Pay Now"/>
            <a class="btn btn-default" href="{{ url('cancel_payment/' . $timestamp) }}"> Go Back </a>
        </div>
    </div>
    <div class="form-group" id="payment-loading" style="display: none;">
        <div class="col-sm-offset-3 col-sm-6" style="text-align: left;">
            <img class="col-sm-1" style="padding: 0px;" src="{{ url('assets/img/loading.gif') }}">
            <span class="col-sm-11" style="padding-right: 0px;">Processing payment. Please don't leave the page.</span>
        </div>
    </div>
    <form/>
@stop
