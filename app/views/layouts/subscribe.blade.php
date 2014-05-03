<!DOCTYPE html>
<html class="full" lang="en"><!-- The full page image background will only work if the html has the custom class set to it! Don't delete it! -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Incorporation Pro</title>

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
  </head>

  <body>

    
    <div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 main well" style="text-align: center;">
				@yield('content')
			</div>
		</div>
    </div>
    
    
    <!-- JavaScript -->

  </body>

</html>

