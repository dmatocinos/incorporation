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
	<link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">

	{{-- Additional Stylesheets --}}
	@section('styles')
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
				<a class="navbar-brand" href="/">Incorporation Tax Planner</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<?php $menu = array(
					'data_entry.index'	=> 'Data Entry',
					'results.show'		=> 'Results',
					'summary.show'		=> 'Summary'
				); ?>
				<ul class="nav navbar-nav side-nav">
				@foreach ($menu as $route => $label)
					<li class="{{ $route == $active ? 'active' : '' }}"><a href="{{ route($route) }}">{{ $label }}</a></li>
				@endforeach
				</ul>

				<ul class="nav navbar-nav navbar-right navbar-user">
					<li class="dropdown user-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
							<li class="divider"></li>
							<li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

		<div id="page-wrapper">

				@section('header')
				<div class="page-header">
					<h1>
						@section('title') 
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

	@section('scripts')
	@show

</body>
</html>
