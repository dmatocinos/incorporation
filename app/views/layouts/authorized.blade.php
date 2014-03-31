<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Incorportation Tax Planner">
	<meta name="author" content="Leonel Tomes">

	<title>
		@section('title') 
		@show | Incorporation Tax Planner
	</title>

	{{-- Bootstrap core CSS --}}
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

	{{-- Add custom CSS here --}}
	<link href="{{ asset('assets/css/sb-admin.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/notify.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">

	{{-- Additional Stylesheets --}}
	@section('styles')
	
	@if (isset($additional_styles))
		@foreach ($additional_styles as $style)
			<link href="{{ asset($style) }}" rel="stylesheet">
		@endforeach
	@endif
	
	@show
</head>

<body>

	<div id="wrapper">

		<!-- Sidebar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url() }}">Incorporation Tax Planner</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				@section('nav')
				<?php 
					if (isset($business)) {
						$menu = array(
							'update'	=> 'Data Entry',
							'results'	=> 'Results',
							'summary'	=> 'Summary',
						//	'goodwill'	=> 'Goodwill <sup><span class="label label-success"><b>PRO</b></span></sup>'
						); 
					}
					else {
						$menu = array();
					}
					
					$active = Request::segment(1);
				?>
				<ul class="nav navbar-nav side-nav">
					<li class="{{ 'create' == $active ? 'active' : '' }}"><a href="{{ url('create') }}">Create</a></li>
					@if ($active != 'create' && ! is_null($active))
						@foreach ($menu as $route => $label)
							<li class="{{ $route == $active ? 'active' : '' }}"><a href="{{ url(sprintf('%s/%s', $route, $business->id)) }}">{{ $label }}</a></li>
						@endforeach
					@endif
				</ul>
				@show

				<ul class="nav navbar-nav navbar-right navbar-user">
					<li class="dropdown user-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->email }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
							<li class="divider"></li>
							<li><a href="{{ URL::route("logout") }}"><i class="fa fa-power-off"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
    <div class='notifications bottom-left'>
	    <div style="float:left; width: 350px;">
			<div style="width: 200px;">
				<a href="http://app.bizvaluation.co.uk" class="thumbnail" title=" Create a professional business valuation in just 15 minutes"><img src="{{ url('assets/img/app-logos/bizval.png') }}" style="width: 200px; padding: 10px 0;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://virtualfdpro.practicepro.co.uk/" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ url('assets/img/app-logos/vfd.png') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://remunerationpro.practicepro.co.uk/" class="thumbnail" title="Maximise your clients' personal income"><img src="{{ url('assets/img/app-logos/remuneration.png') }}" style="width: 80%;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://priceplannerpro.practicepro.co.uk/" class="thumbnail" title="Price professionally and create additional fees"><img src="{{ url('assets/img/app-logos/priceplan.png') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
	    </div>
    </div>
		</nav>

		<div id="page-wrapper">

				@section('header')
				<div class="page-header">
					<h1>
						@section('page_title') 
						@show
					</h1>
				</div>
				@show

			<div class="row">
				<div class="col-lg-12">
					{{-- Content --}}
					@section('content')
					<h1>Blank Page <small>A Blank Slate</small></h1>
					@show
				</div>
			</div><!-- /.row -->

		</div><!-- /#page-wrapper -->

	</div><!-- /#wrapper -->


	<!-- JavaScript -->
	<script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
	
	@if (isset($additional_scripts))
		@foreach ($additional_scripts as $script)
			<script src="{{ asset($script) }}"></script>
		@endforeach
	@endif
	
	@show

</body>
</html>
