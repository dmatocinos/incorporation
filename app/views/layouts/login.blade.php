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
    </div>
    
    
    <!-- JavaScript -->
  </body>

</html>

