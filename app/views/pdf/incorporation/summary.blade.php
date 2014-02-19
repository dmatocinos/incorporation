<div class="report-container">
<h1>
Your Summary of Tax Savings
</h1>
<table class="table">
<tbody>
	<tr>
		<td>Total Tax as a Sole Trader</td>
		<td>{{ $total_savings_data["total_tax_as_a_sole_trader"] }}</td>
	</tr>
	<tr>
		<td>Total Tax as a Partnership</td>
		<td>{{ $total_savings_data["total_tax_as_a_partnership"] }}</td>
	</tr>
	<tr>
		<td>Total Tax with Salary in Limited Company</td>
		<td>{{ $total_savings_data["total_tax_with_salary_in_ltd_co"] }}</td>
	</tr>
	<tr>
		<td>Total Tax with Dividends in Limited Company</td>
		<td>{{ $total_savings_data["total_tax_with_dividends_in_ltd_co"] }}</td>
	</tr>
	<tr class="success">
		<td>Total Annual Tax Savings when Incorporated</td>
		<td>{{ $total_savings_data["total_yearly_tax_savings_by_changing"] }}</td>
	</tr>
	<tr class="active">
		<td>{{ $user->company_name }} Fee (first year only)</td>
		<td>{{ $total_savings_data["bpk_fee_first_year_only"] }}</td>
	</tr>
</tbody>
</table>
<br>

@foreach ($graphs_data as $caption => $path)
<div class="row" style="width: 100%">
	<img style="width: 400px; padding-left: 300px;" src="{{ asset($path) }}" class="img-thumbnail"/>
</div>
@endforeach
</div>
