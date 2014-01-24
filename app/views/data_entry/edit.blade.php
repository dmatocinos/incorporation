@extends('layouts.authorized')

@section('title')
Data Entry
@stop

<?php $active = 'data_entry.index'; ?>

@section('content')
{{ Form::model($business, array('route' => array('data_entry.update', $business->id))) }}
<div class="row">
<div class="col-lg-3">
<?php
$business_entity_types = array('Sole Trader', 'Partnership');
$number_of_partners = range(1, 5);
?>
	<div class="form-group">
		{{ Form::label('business_entity', 'Current entity of the business') }}
		{{ Form::select('business_entity', array_combine($business_entity_types, $business_entity_types), NULL, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('number_of_partners', 'Number of partners') }}
		{{ Form::select('number_of_partners', array_combine($number_of_partners, $number_of_partners), NULL, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('net_profit_before_tax', 'Net profit before tax') }}
		{{ Form::text('net_profit_before_tax', NULL, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('amount_to_distribute', 'Amount to distribute') }}
		{{ Form::text('amount_to_distribute', NULL, array('class' => 'form-control')) }}
	</div>
</div> {{-- .col-lg-3 --}}
<div class="col-lg-9">
{{--
<div class="row">
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Enter Partners') }}
	</div>
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Sole Trader / Partner 1') }}
		<div class="input-group">
			{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
			  <span class="input-group-addon">%</span>
		</div>
	</div>
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Partner 1') }}
		<div class="input-group">
			{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
			  <span class="input-group-addon">%</span>
		</div>
	</div>
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Partner 1') }}
		<div class="input-group">
			{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
			  <span class="input-group-addon">%</span>
		</div>
	</div>
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Partner 1') }}
		<div class="input-group">
			{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
			  <span class="input-group-addon">%</span>
		</div>
	</div>
	<div class="col-lg-2">
		{{ Form::label('share[partner_1]', 'Partner 1') }}
		<div class="input-group">
			{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
			  <span class="input-group-addon">%</span>
		</div>
	</div>
</div>
--}}
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Sole Trader /<br>Partner 1</th>
				<th>Partner 2</th>
				<th>Partner 3</th>
				<th>Partner 4</th>
				<th>Partner 5</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Enter Partners</td>
				<td>
					<div class="input-group">
						{{ Form::text('share[partner_1]', NULL, array('class' => 'form-control')) }}
						  <span class="input-group-addon">%</span>
					</div>
				</td>
				<td>
					<div class="input-group">
						{{ Form::text('share[partner_2]', NULL, array('class' => 'form-control')) }}
						  <span class="input-group-addon">%</span>
					</div>
				</td>
				<td>
					<div class="input-group">
						{{ Form::text('share[partner_3]', NULL, array('class' => 'form-control')) }}
						  <span class="input-group-addon">%</span>
					</div>
				</td>
				<td>
					<div class="input-group">
						{{ Form::text('share[partner_4]', NULL, array('class' => 'form-control')) }}
						  <span class="input-group-addon">%</span>
					</div>
				</td>
				<td>
					<div class="input-group">
						{{ Form::text('share[partner_5]', NULL, array('class' => 'form-control')) }}
						  <span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>{{-- .col-lg-9 --}}
</div>{{-- .row --}}
<hr>
<div class="row">
	<div class="col-lg-4 col-lg-offset-6">
		<div class="input-group">
			<span class="input-group-addon">Fee based on </span>
			{{ Form::text('fee_based_on_tax_saved', NULL, array('class' => 'form-control')) }}
			<span class="input-group-addon">% of tax saved</span>
		</div>
	</div>
	<div class="col-lg-2">
		<input type="submit" class="btn btn-primary" value="Save"/>
	</div>
</div> {{-- .row --}}
{{ Form::close() }}
<div class="row">
@stop
