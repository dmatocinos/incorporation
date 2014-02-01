@extends('layouts.authorized')

<?php $active = 'summary.show'; ?>

@section('title')
Summary
@stop

@section('content')
<a href="{{ route('report.incorporation', $business->id) }}" class="btn btn-success">Download Report</a>
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

