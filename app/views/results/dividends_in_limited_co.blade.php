<?php $count = 0; ?>
<table class="table">
	<thead>
		<th></th>
	@foreach ($business->partners as $partner)
		<th>Partner {{ ++$count }}</th>
	@endforeach
	</thead>
	<tbody>
		<tr>
			<td>Taxable (Dividends)</td>
			@foreach ($dividends_data["taxable_dividends"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<tr>
			<td>Tax Credit</td>
			@foreach ($dividends_data["tax_credit"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>10% Dividends</td>
			@foreach ($dividends_data["10%_dividends"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<tr>
			<td>32.5% Dividends</td>
			@foreach ($dividends_data["32.5%_dividends"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@for ($i = 1; $i <= 2; $i++)
		<tr>
			<td>{{ $i == 1 ? '42.5% Dividends' : '' }}</td>
			@foreach ($dividends_data["42.5%_dividends_{$i}"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@endfor
		<tr class="active">
			<td>Total Tax (Dividends)</td>
			@foreach ($dividends_data["total_tax_dividends"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<tr>
			<td>Net In Pocket</td>
			@foreach ($dividends_data["net_in_pocket"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
</tbody>
</table>
