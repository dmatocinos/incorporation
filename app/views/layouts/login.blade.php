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
          <h1>The Next Big Thing in the Cloud</h1>
	  <br />
          <p>Incorporation (Inc.) is the forming of a new corporation (a corporation being a legal entity that is effectively recognized as a person under the law). The corporation may be a business, a non-profit organization, sports club, or a government of a new city or town. This article focuses on the process of incorporation; see also corporation.</p>
	<br />
          <p>
		Goodwill is best described as what a company’s name or reputation is worth if it was sold. You’ve worked hard to gain a good reputation and this is why Goodwill has a value. So if customers were being attracted to a business because of the name then it is generating customers because of the reputation – this is not something that you can see or touch so it’s ‘intangible’. 
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

