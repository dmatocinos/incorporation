@extends('layouts.authorized');

@section('title')
Summary
@stop

@section('content')
<table class="table">
	<thead>
		<tr>
			<th></th>
			<th>Sole Trade</th>
			<th>Partnership</th>
			<th>Salary in Ltd.</th>
			<th>Dividends</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>Tax</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Corporation Tax</td>
			<td>{{$soletrade_data->data['corporation_tax']}}</td>
			<td>{{$partnership_data->data['corporation_tax']}}</td>
			<td>{{$salary_data->data['corporation_tax']}}</td>
			<td>{{$dividends_data->data['corporation_tax']}}</td>
		</tr>
		<tr>
			<td>Income Tax</td>
			<td>{{$soletrade_data->data['income_tax']}}</td>
			<td>{{$partnership_data->data['income_tax']}}</td>
			<td>{{$salary_data->data['income_tax']}}</td>
			<td>{{$dividends_data->data['income_tax']}}</td>
		</tr>
		<tr>
			<td><strong>National Insurance</strong></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Employer's</td>
			<td>{{$soletrade_data->data['employers_ni']}}</td>
			<td>{{$partnership_data->data['employers_ni']}}</td>
			<td>{{$salary_data->data['employers_ni']}}</td>
			<td>{{$dividends_data->data['employers_ni']}}</td>
		</tr>
		<tr>
			<td>Employee's</td>
			<td>{{$soletrade_data->data['employees_ni']}}</td>
			<td>{{$partnership_data->data['employees_ni']}}</td>
			<td>{{$salary_data->data['employees_ni']}}</td>
			<td>{{$dividends_data->data['employees_ni']}}</td>
		</tr>
		<tr>
			<td>TOTAL TO HMRC</td>
			<td>{{$soletrade_data->data['total_to_hmrc']}}</td>
			<td>{{$partnership_data->data['total_to_hmrc']}}</td>
			<td>{{$salary_data->data['total_to_hmrc']}}</td>
			<td>{{$dividends_data->data['total_to_hmrc']}}</td>
		</tr>
		<tr>
			<td>NET IN POCKET</td>
			<td>{{$soletrade_data->data['net_in_pocket']}}</td>
			<td>{{$partnership_data->data['net_in_pocket']}}</td>
			<td>{{$salary_data->data['net_in_pocket']}}</td>
			<td>{{$dividends_data->data['net_in_pocket']}}</td>
		</tr>
		<tr>
			<td>Left In The Company</td>
			<td>{{$soletrade_data->data['left_in_company']}}</td>
			<td>{{$partnership_data->data['left_in_company']}}</td>
			<td>{{$salary_data->data['left_in_company']}}</td>
			<td>{{$dividends_data->data['left_in_company']}}</td>
		</tr>
		<tr>
			<td>Amount Retained</td>
			<td>{{$soletrade_data->data['amount_retained']}}</td>
			<td>{{$partnership_data->data['amount_retained']}}</td>
			<td>{{$salary_data->data['amount_retained']}}</td>
			<td>{{$dividends_data->data['amount_retained']}}</td>
		</tr>
	</tbody>
</table>
@stop