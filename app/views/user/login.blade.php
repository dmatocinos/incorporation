@section('title')
Login
@stop

@section('content')
	<div class="form-group" style="text-align: center;"><img src="{{ url('assets/img/logo.png') }}" style="width: 80%;"/></div>
	<legend><h3 class="text-center">Please Log In, or <a href="http://www.practicepro.co.uk/membership/register">Register</a></h3></legend>
	    {{ Form::open([
		"route"        => "login",
		"autocomplete" => "off"
	    ]) }}
		<div class="form-group">
		  <label for="username">Username or email</label>
		  <input type="text" name="username" class="form-control" id="username">
		</div>
		<div class="form-group">
		  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
		  <label for="password">Password</label>
		  <input type="password" name="password" class="form-control" id="passsword">
		</div>
		<!--<div class="checkbox pull-right">
		  <label>
		    <input type="checkbox">
		    Remember me </label> 
		</div> -->
			<button type="submit" class="text-center col-xs-12 btn btn-info"> Log In </button>
      	    {{ Form::close() }}
	<legend>&nbsp;</legend>
	@if ($error = $errors->first("password"))
	<div class="alert alert-dismissable alert-danger">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ $error }}
	</div>
	@endif
@stop
