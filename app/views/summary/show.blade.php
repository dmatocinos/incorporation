@extends('layouts.authorized')

<?php $active = 'summary.show'; ?>

@section('title')
Summary
@stop
@section('page_title')
Summary <a href="{{ route('report.incorporation', $business->id) }}" class="btn btn-success">Download Report</a>
@stop

@section('content')
	@if (Session::get('message'))
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info alert-block">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('message') }}
			</div>
		</div>
	</div>
	@endif
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

