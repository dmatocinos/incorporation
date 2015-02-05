<p>
	
</p>
@section('Title')
Payment
@stop

@section('client')
@stop

@section('content')
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>You choose to cancel the payment for your report. You can go back and pay for this report later.</label>
	</div>
	<div class="payment" style="margin: 30px 0px 0px; text-align: center; width: 100%;">
		<a style="font-size: 18px; float: center;" class="text-center col-xs-6 btn btn-primary" href="{{ url('iht-payment-start?iht_id=' . $iht_id) }}"> Pay now! </a>
	</div>
@stop

