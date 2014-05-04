@section('content')
	<div class="form-group"><img src="{{ asset('assets/img/logo.png') }}" style="width: 60%;"/></div>
	<legend><h3>You've reached the limit to download a report.</a></h3></legend>
	
	@if ($level == 'Pro Active') 
	<div class="form-group">
	  <label>{{ $msg }} </label>
	</div>
	<div class="subscribe" style="margin: 30px 0px 0px; text-align: center; width: 100%; float: left;">
		<a style="font-size: 18px; float: center;" class="text-center col-xs-9 btn btn-success logo-color-bg" href="{{ url('upgrade/start_payment/third') }}">Upgrade to <b>Professional</b> for only £499.00 and have up to 41 downloads</a>
	</div>
	@elseif ($level == 'Pay As You Go') 
	<div class="form-group">
	  <label>{{ $msg }} </label>
	</div>
	<div class="subscribe" style="margin: 30px 0px 0px; text-align: center; width: 100%; float: left;">
		<a style="font-size: 18px; float: center;" class="text-center col-xs-9 btn btn-success logo-color-bg" href="{{ url('upgrade/start_payment/second') }}">Upgrade to <b>Pro Active</b> for only £99.0 and have up to 11 downloads</a>
	</div>
	<div class="subscribe" style="margin: 30px 0px 0px; text-align: center; width: 100%; float: left;">
		<a style="font-size: 18px; float: center;" class="text-center col-xs-9 btn btn-success logo-color-bg" href="{{ url('upgrade/start_payment/third') }}">Upgrade to <b>Professional</b> for only £499.00 and have up to 41 downloads</a>
	</div>
	@endif
	<div class="subscribe" style="margin: 20px 0px 30px; text-align: center; width: 100%; float: left;">
		<a class="btn btn-default" href="{{ url('upgrade/cancel_payment/') }}"> Go Back </a>
	</div>
@stop
