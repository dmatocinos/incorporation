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
		<td>BPK Fee (first year only)</td>
		<td>{{ $total_savings_data["bpk_fee_first_year_only"] }}</td>
	</tr>
</tbody>
</table>
<br>

@foreach ($graphs_data as $caption => $path)
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<a href="#" class="thumbnail">
		<img src="{{ asset($path) }}" class="img-thumbnail"/>
	</a>
	</div>
</div>
@endforeach
