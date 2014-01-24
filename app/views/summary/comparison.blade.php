<table class="table">
<thead>
	<tr>
		<th></th>
		<th>Sole Trade</th>
		<th>Partnership</th>
		<th>Salary In Ltd</th>
		<th>Dividends</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="100%">Tax</th>
	</tr>
	<tr>
		<td>Corporation Tax</td>
		@foreach ($comparison_data['corporation_tax'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<td>Income Tax</td>
		@foreach ($comparison_data['income_tax'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr>
		<th colspan="100%">National Insurance</th>
	</tr>
	<tr>
		<td>Employer's</td>
		@foreach ($comparison_data['employer'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<td>Employee's</td>
		@foreach ($comparison_data['employee'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="danger">
		<th>TOTAL TO HMRC</th>
		@foreach ($comparison_data['total_to_hmrc'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="success">
		<th>Net in Pocket</th>
		@foreach ($comparison_data['net_in_pocket'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<th>Left in the Company</th>
		@foreach ($comparison_data['left_in_company'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="success">
		<th>AMOUNT RETAINED</th>
		@foreach ($comparison_data['amount_retained'] as $tax)
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

</tbody>
</table>
