<!DOCTYPE html>
<html class="full" lang="en">
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
	<link href="{{ asset('assets/css/the_big_picture.css') }}" rel="stylesheet">
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
      
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-5 blob">
          <h1>Incorporation PlannerPro</h1>
	  <br />
          <p>Incorporation PlannerPro enables a PracticePro member to show a client or a prospect the potential tax savings from incorporating their business.</p>
	<br />
          <p>
		<b>Key Features:</b>
		<ul>
			<li>
				 Incorporation PlannerPro shows you the potential savings of incorporating a client’s business.
			</li>
			<li>
				It provides an exact figure in a beautifully presented report.
			</li>
			<li>
				A potentially easy sell as incorporating a business has many advantages to a client.
			</li>
			<li>
				 It will show you how to take a salary and dividends out of a limited company and will highlight how the tax is treated on both.
			</li>
			<li>
				The software is extremely easy to use.
			</li>
		</ul>
	</p>
        </div>
        <div class="col-lg-4 pull-right">
      	   <div class="main well">
		@yield('content')
	   </div>
        </div>
      </div>
	<div class="row" style="height: 230px;">
		
	</div>
	<div class="row">
		<div class="col-md-8 col-sm-8 blob">
			<h1>See other services we offer</h1>
			<br/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-3" style="margin-left: 20px; margin-bottom: 0">
			<div style="width: 280px;">
				<a href="http://app.bizvaluation.co.uk" class="thumbnail" target="_blank" title=" Create a professional business valuation in just 15 minutes"><img src="{{ asset('assets/img/app-logos/bizvaluation_logo.png') }}" style="width: 100%; padding: 10px 0;"/></a>
			</div>
			<div style="width: 280px;">
				<a href="http://practicepro.co.uk/incorporation/public/" target="_blank" class="thumbnail" title="Price professionally and create additional fees"><img src="{{ asset('assets/img/app-logos/priceplannerpro_logo.png') }}" style="width: 95%;"/></a>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 " style="margin-left: 20px;">
			<div style="width: 280px;">
				<a href="http://virtualfdpro.practicepro.co.uk/" target="_blank" class="thumbnail" title="Help your clients achieve their goals"><img src="{{ asset('assets/img/app-logos/virtualfdpro_logo.jpg') }}" style="width: 100%; padding: 5px;"/></a>
			</div>
			<div style="width: 280px;">
				<a href="http://remunerationpro.practicepro.co.uk/" target="_blank" class="thumbnail" title="Maximise your clients' personal income"><img src="{{ asset('assets/img/app-logos/remuneration_logo.png') }}" style="width: 50%;"/></a>
			</div>
		</div>
	</div>
    </div>
    
    
    <!-- JavaScript -->
  </body>

</html>

