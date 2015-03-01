<div class="col-lg-8 col-lg-offset-2 well">
	<table class="table">
	<thead>
		<tr>
			<th colspan="2">Total Savings</th>
		</tr>
	<tbody>
        <?php if ($business->isPartnership()) : ?>
		<tr>
			<td>Total Tax as a Partnership</td>
			<td>{{ $total_savings_data["total_tax_as_a_partnership"] }}</td>
		</tr>
        <?php else : ?>
		<tr>
			<td>Total Tax as a Sole Trader</td>
			<td>{{ $total_savings_data["total_tax_as_a_sole_trader"] }}</td>
		</tr>
        <?php endif; ?>
		<tr>
			<td>Total Tax as Incorporated Company</td>
			<td>{{ $total_savings_data["total_tax_as_incorporated"] }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="success">
			<td>Total Annual Tax Savings</td>
			<td>{{ $total_savings_data["total_annual_tax_savings"] }}</td>
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
