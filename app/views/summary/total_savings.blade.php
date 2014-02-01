<div class="col-lg-8 col-lg-offset-2 well">
	<table class="table">
	<thead>
		<tr>
			<th colspan="2">Total Savings</th>
		</tr>
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
			<td>Total Tax with Salary in Ltd Co</td>
			<td>{{ $total_savings_data["total_tax_with_salary_in_ltd_co"] }}</td>
		</tr>
		<tr>
			<td>Total Tax with Dividends in Ltd Co</td>
			<td>{{ $total_savings_data["total_tax_with_dividends_in_ltd_co"] }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="success">
			<td>Total <u>Yearly</u> Tax Savings by Changing</td>
			<td>{{ $total_savings_data["total_yearly_tax_savings_by_changing"] }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="active">
			<td>{{ $user->company_name }} Fee (first year only)</td>
			<td>{{ $total_savings_data["bpk_fee_first_year_only"] }}</td>
		</tr>
	</tbody>
	</table>
</div>
