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
	<link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">

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
							'business'	=> 'Data Entry',
						//	'results'	=> 'Results',
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
					<li class="{{ 'create' == $active ? 'active' : '' }}">
                        @if (empty($current_clients))
                            <a href="{{ url('business/new') }}"><i class="fa fa-plus-square-o fa-fw"></i> Create New</a>
                        @else
						    <a href="#" data-toggle="modal" data-target="#clientModal"><i class="fa fa-plus-square-o fa-fw"></i> Create New</a>
                        @endif
					</li>
					@if ($active != 'create' && ! is_null($active))
						@foreach ($menu as $route => $label)
                            @if ($business->id || $route == 'business')
                                <li class="{{ $route == $active ? 'active' : '' }}">
                                    <a href="{{ $route == $active ? '#' : url(sprintf('%s/%s', $route, $business->id)) }}">{{ $label }}</a>
                                </li>
                            @endif
						@endforeach
					@endif
				</ul>
				@show

				<ul class="nav navbar-nav navbar-right navbar-user">
					<li class="dropdown">
					    <a class="dropdown-toggle" data-toggle="modal" data-target="#myModal" href="#">
						<i class="fa fa-comments-o fa-fw"></i> Support 
					    </a>
					</li>
					<li class="dropdown user-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->email }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<!--li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-gear"></i> Settings</a></li-->
							<li class="divider"></li>
							<li><a href="{{ URL::route("logout") }}"><i class="fa fa-power-off"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
    <div class='notifications bottom-left'>
	    <div style="float:left;">
			<div style="width: 200px;">
				<a href="http://www.practicepro.co.uk/bizvaluation" class="thumbnail" target="_blank" title=" Create a professional business valuation in just 15 minutes"><img src="{{ asset('assets/img/app-logos/bizval.png') }}" style="width: 200px; padding: 10px 0;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://www.practicepro.co.uk/virtualfd" class="thumbnail" target="_blank" title="Help your clients achieve their goals"><img src="{{ asset('assets/img/app-logos/vfd.png') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://www.practicepro.co.uk/remuneration" class="thumbnail" target="_blank" title="Maximise your clients' personal income"><img src="{{ asset('assets/img/app-logos/remuneration.png') }}" style="width: 80%;"/></a>
			</div>
			<div style="width: 200px;">
				<a href="http://www.practicepro.co.uk/priceplanner" class="thumbnail" target="_blank" title="Price professionally and create additional fees"><img src="{{ asset('assets/img/app-logos/priceplan.png') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
	    </div>
    </div>
		</nav>

		<div id="page-wrapper">
				@if (isset($notification))
					<div class="alert alert-success alert-block" style="margin: 20px;">
						<b>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{{ $notification['text'] }}
						</b>
					</div>
				@endif

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

<!-- Product Recommendation -->
@if(Session::get('has_recommendation'))
<div class="modal fade" id="product_recommendation_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="product_recommendation">Did you know...</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="span12" style="padding: 15px;">
				<h4>
					This client is suitable for the Darwin Corporation Tax mitigation structure.
					<b>You can earn {{ Auth::user()->practicepro_user->getProductCommission() * 100 }}% commission</b> for successfully referring this client whilst
					helping them minimise their Corporation Tax exposure.
				</h4>
				<br>
				<h4>
					Click <a href="http://www.contractorspro.co.uk/about-us">here</a> to learn more about Darwin and how both you and your client benefit
				</h4>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{ Form::open(array('route' => 'email_support')) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Support</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="span12" style="padding: 15px;">
				<h4>We aim to make you feel comfortable with our service, please let us know how we can help you further.</h4>
				<br>
				<fieldset>
					{{ Form::token() }}
					<div class="form-group">
						<label for="msg_subject">Subject</label>
						<input name="subject" type="text" class="form-control" id="msg_subject" placeholder="What is it about?" required="required">
					</div>
					<div class="form-group">
						<label for="msg_message">Message</label>
						<textarea name="msg" class="form-control" row="3" style="height: 120px;" id="msg_message" placeholder="Please provide more details." required="required"></textarea>
					</div>
				</fieldset>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<!-- Client Select Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{ Form::open(array('route' => 'business_create')) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Client Details</h4>
      </div>
      <div class="modal-body">
	<div class="row">
		<div class="col-lg-12" style="padding: 15px;">
		<fieldset>
			{{ Form::token() }}
			  <div class="form-group">
				    <label for="" class="col-lg-12 control-label">Add client details for the new incorporation. Choose which one you prefer to retrieve client details.</label>
				    <div class="col-lg-12">
					<div class="radio">
					  <label>
					    <input type="radio" name="select_by" id="existing" value="existing" checked>
						From Existing Clients		
						{{ 
							Form::select(
								'client_id', $current_clients, 
								null,
								array(
									'class' => 'form-control', 
							)) 
						}}
					  </label>
					</div>
				    </div>
				    <br>
				    <div class="col-lg-12">
					<div class="radio">
					  <label>
					    <input type="radio" name="select_by" id="new_client" value="new_client">
						Add New Client
					  </label>
					</div>
				    </div>
			  </div>
		</fieldset>
		</div>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Modal -->

	<!-- JavaScript -->
	<script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
	<script src="{{ asset('assets/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
	
	@if (isset($additional_scripts))
		@foreach ($additional_scripts as $script)
			<script src="{{ asset($script) }}"></script>
		@endforeach
	@endif
	
	@show

</body>
</html>
