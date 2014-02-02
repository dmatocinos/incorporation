@extends('layouts.authorized')

<?php $active = 'goodwill.show'; ?>

@section('title')
Goodwill
@stop

@section('page_title')
Goodwill
	<a href="{{ url(sprintf('%s/%s', 'goodwill/report', $business->id)) }}" class="btn btn-success">Download Report</a>
@stop

@section('content')
	<legend>Capital Gain on Business Transfer</legend>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
				<tbody>
					<tr>
						<td style="border-style: none;">Gain before tax due</td>
						<td style="border-style: none; width: 150px;">{{ $data['capital_gain_on_business_transfer']['gain_before_tax_due'] }}</td>
					</tr>
					<tr>
						<td>Less annual exemption</td>
						<td>{{ $data['capital_gain_on_business_transfer']['less_annual_exemption']  }}</td>
					</tr>
					<tr>
						<td>Gain liable to capital gains tax</td>
						<td>{{ $data['capital_gain_on_business_transfer']['gain_liable_to_capital_gains_tax'] }}</td>
					</tr>
					<tr class="info">
						<td><b>Possible total tax due on gain</b></td>
						<td><b>{{ $data['capital_gain_on_business_transfer']['possible_total_tax_due_on_gain'] }}</b></td>
					</tr>
				</tbody>	
			</table>
		</div>
	</div>

	<br/>
	<legend>Possible tax savings on goodwill being amortised</legend>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
				<tbody>
					<tr>
						<td style="border-style: none;">Possible tax savings on goodwill amortised</td>
						<td style="border-style: none; width: 150px;">{{ $data['possible_tax_savings']['possible_tax_savings_on_goodwill_amortised'] }}</td>
					</tr>
					<tr>
						<td>First year savings in the company <em class="text-info">(First year saving used in BPK)</em></td>
						<td style="width: 150px;">{{ $data['possible_tax_savings']['first_year_savings_in_the_company'] }}</td>
					</tr>
				</tbody>	
			</table>
		</div>
	</div>

	<br/>
	<legend>Tax if Value of Goodwill Taken by Dividends</legend>
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
				<thead>
					<tr>
						<th style="" colspan="3"></th>
						<th class="">Gross Dividend</th>
						<th class="">Tax Due</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="3">Partner 1</td>
						<td class="">{{ isset($data['tax_by_dividend'][1]) ? $data['tax_by_dividend'][1]['gross_dividend'] : '-' }}</td>
						<td class="">{{ isset($data['tax_by_dividend'][1]) ? $data['tax_by_dividend'][1]['tax_due'] : '-' }}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Partner 2</td>
						<td class="">{{ isset($data['tax_by_dividend'][2]) ? $data['tax_by_dividend'][2]['gross_dividend'] : '-' }}</td>
						<td class="">{{ isset($data['tax_by_dividend'][2]) ? $data['tax_by_dividend'][2]['tax_due'] : '-' }}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Partner 3</td>
						<td class="">{{ isset($data['tax_by_dividend'][3]) ? $data['tax_by_dividend'][3]['gross_dividend'] : '-' }}</td>
						<td class="">{{ isset($data['tax_by_dividend'][3]) ? $data['tax_by_dividend'][3]['tax_due'] : '-' }}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Partner 4</td>
						<td class="">{{ isset($data['tax_by_dividend'][4]) ? $data['tax_by_dividend'][4]['gross_dividend'] : '-' }}</td>
						<td class="">{{ isset($data['tax_by_dividend'][4]) ? $data['tax_by_dividend'][4]['tax_due'] : '-' }}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Partner 5</td>
						<td class="">{{ isset($data['tax_by_dividend'][5]) ? $data['tax_by_dividend'][5]['gross_dividend'] : '-' }}</td>
						<td class="">{{ isset($data['tax_by_dividend'][5]) ? $data['tax_by_dividend'][5]['tax_due'] : '-' }}</td>
						<td></td>
					</tr>
					<tr class="info">
						<td colspan="3"><b>Total dividend tax if taken as a dividend</b></td>
						<td class=""></td>
						<td class=""><b>{{ $data['tax_by_dividend']['total_dividend_tax_if_dividend'] }}</b></td>
						<td></td>
					</tr>
				</tbody>	
			</table>
		</div>
	</div>

	<br/>
	<legend>Summary</legend>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 well">
			<table class="table">
				<tbody>
					<tr>
						<td>Cost in C.G.T on business transfer</td>
						<td class="text-danger"><b>{{ $data['summary']['cost_in_cgt_on_business_partner']}}</b></td>
					</tr>
					<tr>
						<td>Goodwill savings obtained (first year)</td>
						<td><b>{{ $data['summary']['goodwill_savings_obtained'] }}</b></td>
					</tr>
					<tr>
						<td>Dividend tax saved on extraction</td>
						<td><b>{{ $data['summary']['dividend_tax_saved_on_extraction'] }}</b></td>
					</tr>
					<tr class="success">
						<td><b>Net savings made</b></td>
						<td><b>{{ $data['summary']['net_savings_made'] }}</b></td>
					</tr>
					<tr>
						<td><em>Overall savings (all goodwill)</em></td>
						<td><b>{{ $data['summary']['overall_savings'] }}</b></td>
					</tr>
					<tr class="info">
						<td><b>BPK fee for capitalisation</b></td>
						<td><b>{{ $data['summary']['bpk_fee_for_capitalisation'] }}</b></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	@foreach ($data['graphs'] as $caption => $path)
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
		<a href="#" class="thumbnail">
			<img src="{{ asset($path) }}" class="img-thumbnail"/>
		</a>
		</div>
	</div>
	@endforeach
@stop

