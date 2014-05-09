@extends('layouts.authorized')

@section('title')
Data Entry
@stop

@section('page_title')
Data Entry
@stop
<?php $active = 'data_entry.index'; ?>

@section('content')

@if ($errors->any())
<div class="row">
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Error</h4>
		{{ Session::get('message') }}
	</div>
</div>
@endif

<div ng-app="BvApp" id="bv-content" class="">
	{{ Form::open(array('url' => $url, 'method' => 'PUT','class' => 'form-horizontal')) }}

	<legend>Incorporation</legend>
	<div class="row">
		<?php
			$business_entity_types = array('Sole Trader', 'Partnership');
			$number_of_partners = range(2, 5);
		?>
		<div class="col-lg-8">
			<div class="form-group">
				{{ Form::label('business_entity', 'Current entity of the business', array('class' => 'col-lg-3 control-label')) }}
				<div class="col-lg-5">
					{{ Form::select('business_entity', array_combine($business_entity_types, $business_entity_types), $business->business_entity, array('class' => 'form-control')) }}
					{{ $errors->first('business_entity', '<span class="help-block">:message</span>') }}
				</div>
			</div>
			<div class="form-group" id="number_partners_container" style="display: none;">
				{{ Form::label('number_of_partners', 'Number of partners', array('class' => 'col-lg-3 control-label')) }}
				<div class="col-lg-5">
					{{ Form::select('number_of_partners', array_combine($number_of_partners, $number_of_partners), count($business->partners), array('class' => 'form-control')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('net_profit_before_tax', 'Net profit before tax', array('class' => 'col-lg-3 control-label')) }}
				<div class="col-lg-5">
					{{ 
						Form::text('net_profit_before_tax', $business->net_profit_before_tax, array(
							'class' => 'form-control', 
							'ng-model' 	=> 'C1', 
							'ng-init' 	=> "C1='{$business->net_profit_before_tax}'",
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required'
						)) 
					}}
					{{ $errors->first('net_profit_before_tax', '<span class="help-block">:message</span>') }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('amount_to_distribute', 'Amount to distribute', array('class' => 'col-lg-3 control-label')) }}
				<div class="col-lg-5">
					{{ 
						Form::text('amount_to_distribute', $business->amount_to_distribute, array(
							'class' => 'form-control',
							'ng-model' 	=> 'D1', 
							'ng-init' 	=> "D1='{$business->amount_to_distribute}'",
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required'
						)) 
					}}
					{{ $errors->first('amount_to_distribute', '<span class="help-block">:message</span>') }}
				</div>
			</div>
		</div> {{-- .col-lg-9 --}}
	</div>{{-- .row --}}

<!--
	<br /><br />
	<legend>Goodwill</legend>
	<div class="row">
		<div class="col-lg-8">
			<div class="form-group">
				{{ Form::label('goodwill_estimated_value', 'Estimated value for goodwill', array('class' => 'col-lg-3 control-label')) }}
			    	<div class="col-lg-5">
					{{ 
						Form::text('goodwill_estimated_value', $business->goodwill_estimated_value, array(
							'class' => 'form-control',
							'ng-model' 	=> 'E10', 
							'ng-init' 	=> "E10='{$business->amount_to_distribute}'",
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required'
						)) 
					}}
					{{ $errors->first('goodwill_estimated_value', '<span class="help-block">:message</span>') }}
			    	</div>
			</div>
			<div class="form-group">
				{{ Form::label('existing_business_commenced', 'Existing business commenced post 01/04/2002', array('class' => 'col-lg-3 control-label')) }}
			    	<div class="col-lg-5">
					{{ 
						Form::select('existing_business_commenced', array('yes' => 'Yes', 'no' => 'No'), $business->existing_business_commenced, array(
							'class' => 'form-control'
						)) 
					}}
			    	</div>
			</div>
			<div class="form-group">
				{{ Form::label('goodwill_write_off_years', 'Goodwill  write off by how many years', array('class' => 'col-lg-3 control-label')) }}
			    	<div class="col-lg-5">
					{{ 
						Form::text('goodwill_write_off_years', $business->goowill_write_off_years, array(
							'class' => 'form-control',
							'ng-model' 	=> 'E17', 
							'ng-init' 	=> "E17='{$business->goodwill_write_off_years}'",
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required'
						)) 
					}}
					{{ $errors->first('goodwill_estimated_value', '<span class="help-block">:message</span>') }}
			    	</div>
			</div>
		</div>
	</div> {{-- .row --}}
-->	
	<br /><br />
	<legend>Partners</legend>

	<div class="row">
		<div class="col-lg-12">
			<table class="table">
				<thead>
					<tr>
						<th style="border-style: none; width: 150px;"></th>
						<th style="border-style: none;">Partner 1</th>
						<th style="border-style: none;">Partner 2</th>
						<th style="border-style: none;">Partner 3</th>
						<th style="border-style: none;">Partner 4</th>
						<th style="border-style: none;">Partner 5</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width: 150px"><label>Partners' Share</label></td>
						@for ($i = 0; $i < 5; $i++)
							<?php
								$name = "partners[{$i}][share]";
								
								if (is_array($business->partners)) {
									if (isset($business->partners[$i])) {
										$partner = $business->partners[$i];
										$value = $partner ? $partner['share'] : '';
									}
									else {
										$value = '';
									}
								}
								else {
									$partner = $business->partners->get($i);
									$value = $partner ? $partner->share : '';
								}
								
								$init_val =  (int) $i == 0 && ($business->business_entity == 'Sole Trader' || $business->business_entity == '') ? 100 : $value; 
							?>
					
							<td>
								<div class="input-group">
									{{ 
										Form::text($name, Input::old($name, $value), array(
											'class' => 'form-control partners_share',
											'ng-model' 	=> 'E' . $i, 
											'ng-init' 	=> "E" . $i . "='{$init_val}'",
											'numbers-only'	=> 'numbers-only',
											'required'	=> 'required',
											'id'		=> "partner_share_{$i}"
										)) 
									}}
									<span class="input-group-addon">%</span>
								</div>
							</td>
						@endfor
					</tr>
				</tbody>
			</table>
		</div>{{-- .col-lg-12 --}}
	</div>{{-- .row --}}

	<hr>
	<div class="row">
		<div class="col-lg-4">
			<div class="input-group">
				<span class="input-group-addon">Fee based on </span>
				{{ 
					Form::text('fee_based_on_tax_saved', $business->fee_based_on_tax_saved, array(
						'class' => 'form-control fee-base-on-tax-saved',
						'ng-model' 	=> 'F1', 
						'ng-init' 	=> "F1='{$business->fee_based_on_tax_saved}'",
						'numbers-only'	=> 'numbers-only',
						'required'	=> 'required'
					)) 
				}}
				<span class="input-group-addon">% of tax saved</span>
			</div>
		</div>
		<div class="col-lg-4">
			<input type="submit" class="btn btn-primary" name="save_button" value="Save"/>
            <input type="submit" class="btn btn-primary" name="save_and_next_button" value="Save & Next"/>
		</div>
	</div> {{-- .row --}}

	{{ Form::close() }}
</div>
@stop

