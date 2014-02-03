@extends('layouts.authorized')

<?php $active = 'results.show'; ?>

@section('title')
Results
@stop

@section('page_title')
Results
@stop

@section('content')
<ul class="nav nav-pills nav-justified">
	<li class="active"><a href="#salary" data-toggle="tab">Salary in Limited Co</a></li>
	<li><a href="#partnership" data-toggle="tab">Partnership Tax and National Insurance</a></li>
	<li><a href="#dividends" data-toggle="tab">Dividends in Limited Co</a></li>
</ul>
<hr>

<div class="tab-content">
	<div class="tab-pane active fade in" id="salary">
		@include('results/salary_in_limited_co')
	</div>
	<div class="tab-pane fade" id="partnership">
		@include('results/partnership_tax_and_national_insurance')
	</div>
	<div class="tab-pane fade" id="dividends">
		@include('results/dividends_in_limited_co')
	</div>
</div>
@stop
