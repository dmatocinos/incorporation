@extends('layouts.authorized')

<?php $active = 'summary.show'; ?>

@section('title')
Summary
@stop

@section('content')
<div class="row">
	<div class="col-lg-12">
		@include('summary/comparison')
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12">
		@include('summary/total_savings')
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12">
		@include('summary/graphs')
	</div>
</div>
@stop
