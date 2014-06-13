@extends('layouts.authorized')

@section('title')
Client Details
@stop

@section('page_title')
Client Details
@stop

@section('content')
<div style="padding: 20px 50px;">
	@if ($errors->any())
	<div class="row">
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Error</h4>
			{{ Session::get('message') }}
		</div>
	</div>
	@endif
	
	<?php
		$business_entity_types = array('Sole Trader', 'Partnership');
		$number_of_partners = range(2, 5);

		if (isset($client_data['id'])) {
			$route = 'update_client';
			$client_data['period_start_date'] =  date('m/d/Y', strtotime($client_data['period_start_date']));
			$client_data['period_end_date'] =  date('m/d/Y', strtotime($client_data['period_end_date']));
			$country = $client_data['country'];
		}
		else {
			$route = 'create_client';
			$country = 'United Kingdom';
		}
		
	?>
				
	<div ng-app="BvApp" id="bv-content" class="">
		{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'form-horizontal')) }}

		<div class="row">	
			<div class="col-lg-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    <i class="fa fa-th-large fa-fw"></i> Incorporation
				</div>
				<div class="panel-body">
					
				    <fieldset>
						<div class="form-group">
							{{ Form::label('business_entity', 'Current entity of the business', array('class' => 'col-lg-2 control-label')) }}
							<div class="col-lg-4">
								{{ Form::select('business_entity', array_combine($business_entity_types, $business_entity_types), $business->business_entity, array('class' => 'form-control')) }}
								{{ $errors->first('business_entity', '<span class="help-block">:message</span>') }}
							</div>
						</div>
						<div class="form-group" id="number_partners_container" style="display: none;">
							{{ Form::label('number_of_partners', 'Number of partners', array('class' => 'col-lg-2 control-label')) }}
							<div class="col-lg-4">
								{{ Form::select('number_of_partners', array_combine($number_of_partners, $number_of_partners), $business->number_of_partners, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('net_profit_before_tax', 'Net profit before tax', array('class' => 'col-lg-2 control-label')) }}
							<div class="col-lg-4">
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
							{{ Form::label('fee_based_on_tax_saved', 'Fee based on', array('class' => 'col-lg-2 control-label')) }}
							<div class="col-lg-4">
						 	   <div class="col-lg-7" style="padding: 0px;">
								{{ 
								    Form::text('fee_based_on_tax_saved', $business->fee_based_on_tax_saved, array(
									'class' => 'form-control fee-base-on-tax-saved',
									'ng-model' 	=> 'F1', 
									'ng-init' 	=> "F1='{$business->fee_based_on_tax_saved}'",
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required',
									'style' => 'border-radius: 4px 0px 0px 4px;'
								    )) 
								}}
							    </div>
							    <span class="input-group-addon" style="height: 34px;">% of tax saved</span>
							</div>
						 </div>

					</fieldset>
				   </div>
			     </div>
		       </div>
		</div>
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Client Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
					@if(isset($client_data['id']))
					<input type="hidden" name="id" value="{{ $client_data['id'] }}">
					@endif
				    	<label for="business_name" class="col-sm-2 control-label">Business Name</label>
					<div class="col-sm-4">
						{{ 
							Form::text('business_name', $client_data['business_name'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("business_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-2 control-label">Contact Name</label>
					<div class="col-sm-4">
						{{ 
							Form::text('contact_name', $client_data['contact_name'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("contact_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-2 control-label">Accounting Period</label>
					<div class="col-sm-7">
					    <div class="row">
						<span class="col-sm-4">
							{{ 
								Form::text('period_start_date', $client_data['period_start_date'], array(
									'class' => 'form-control', 
									'id' => 'period_start_date',
									'placeholder' => 'Period Start'
								)) 
							}}
						</span>
						<span class="col-md-1">
							<b>&nbsp;_</b>
						</span>
						<span class="col-sm-4">
							{{ 
								Form::text('period_end_date', $client_data['period_end_date'], array(
									'class' => 'form-control', 
									'id' => 'period_end_date',
									'placeholder' => 'Period End'
								)) 
							}}
						</span>
					    </div>
				    	</div>
				    </div>

				</fieldset>

			</div>
		    </div>
		</div>
		</div>

		<div class="row">	
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-suitcase fa-fw"></i> Business Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				  <div class="form-group">
				    	<label for="year_end" class="col-sm-2 control-label">Year End</label>
					<div class="col-sm-4">
						{{ 
							Form::text('year_end', $client_data['year_end'], array(
								'class' => 'form-control input-sm', 
								'id' => 'year_end', 
								'placeholder' => 'day, Month',
							))
						}}
						@if ($error = $errors->first("year_end"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="business_status" class="col-sm-2 control-label">Business Status</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'business_status', ['' => '', 'Trading' => 'Trading', 'Investment' => 'Investment'], 
								$client_data['business_status'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="industry_sector" class="col-sm-2 control-label">Industry Sector</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'industry_sector', 
								[
									'' => '', 
									'Accounting Practice' => 'Accounting Practice',
									'Banking' => 'Banking',
									'Business Services' => 'Business Services',
									'Construction' => 'Construction',
									'Education/Training' => 'Education/Training',
									'Financial Services' => 'Financial Services',
									'Health' => 'Health',
									'Insurance' => 'Insurance',
									'IT/Telecomms' => 'IT/Telecomms',
									'Law' => 'Law',
									'Logistics' => 'Logistics',
									'Management Consultancy' => 'Management Consultancy',
									'Manufacturing/Engineering' => 'Manufacturing/Engineering',
									'Marketing/PR' => 'Marketing/PR',
									'Media/Entertainment' => 'Media/Entertainment',
									'Oil, Gas, Mining' => 'Oil, Gas, Mining',
									'Other' => 'Other',
									'Property' => 'Property',
									'Public Sector/Charity' => 'Public Sector/Charity',
									'Retail/Wholesale' => 'Retail/Wholesale',
									'Utilities' => 'Utilities'
								],
								$client_data['industry_sector'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="currency" class="col-sm-2 control-label">Currency</label>
					<div class="col-sm-4">
						{{ 
							Form::select(
								'currency', $currencies, 
								$client_data['currency'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("currency"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>


				</fieldset>

			</div>
		    </div>
		</div>
		</div>

		<div class="row">	
  		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-home fa-fw"></i> Contact Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
				    	<label for="address_1" class="col-sm-2 control-label">Street Address</label>
					<div class="col-sm-4">
						{{ 
							Form::text('address_1', $client_data['address_1'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("address_1"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="city" class="col-sm-2 control-label">Town/City</label>
					<div class="col-sm-4">
						{{ 
							Form::text('city', $client_data['city'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("city"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="countty" class="col-sm-2 control-label">County</label>
					<div class="col-sm-4">
						{{ 
							Form::select('county', $counties,
								$client_data['county'],
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("county"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="country" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-4">
						{{ 
							Form::select('country', $countries,
								$country,
								array(
									'class' => 'form-control', 
							)) 
						}}
						@if ($error = $errors->first("country"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="postcode" class="col-sm-2 control-label">Postcode</label>
					<div class="col-sm-4">
						{{ 
							Form::text('postcode', $client_data['postcode'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("postcode"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
					<div class="col-sm-4">
						{{ 
							Form::text('phone_number', $client_data['phone_number'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("phone_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="mobile_number" class="col-sm-2 control-label">Mobile Number</label>
					<div class="col-sm-4">
						{{ 
							Form::text('mobile_number', $client_data['mobile_number'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("mobile_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-4">
						{{ 
							Form::text('email', $client_data['email'], array(
								'class' => 'form-control',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("email"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="website" class="col-sm-2 control-label">Website</label>
					<div class="col-sm-4">
						{{ 
							Form::text('website', $client_data['website'], array(
								'class' => 'form-control',
							)) 
						}}
						@if ($error = $errors->first("website"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>


				</fieldset>

				</div>
			    </div>
			</div>

                </div>

		
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-primary btn-save" type="submit" name="save_next_page" id="save_next_page" >&nbsp;<i class="fa fa-save"></i> Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">&nbsp;<i class="fa fa-save"></i> Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
</div>

@stop

