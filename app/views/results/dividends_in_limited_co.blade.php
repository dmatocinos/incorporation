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
			<td>{{ implode('<td></td>', $dividends_data["taxable_dividends"]) }}</td>
		</tr>
		<tr>
			<td>Tax Credit</td>
			<td>{{ implode('<td></td>', $dividends_data["tax_credit"]) }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>10% Dividends</td>
			<td>{{ implode('<td></td>', $dividends_data["10%_dividends"]) }}</td>
		</tr>
		<tr>
			<td>32.5% Dividends</td>
			<td>{{ implode('<td></td>', $dividends_data["32.5%_dividends"]) }}</td>
		</tr>
	@for ($i = 1; $i <= 2; $i++)
		<tr>
			<td>{{ $i == 1 ? '42.5% Dividends' : '' }}</td>
			<td>{{ implode('<td></td>', $dividends_data["42.5%_dividends_{$i}"]) }}</td>
		</tr>
	@endfor
		<tr class="active">
			<td>Total Tax (Dividends)</td>
			<td>{{ implode('<td></td>', $dividends_data["total_tax_dividends"]) }}</td>
		</tr>
		<tr>
			@for ($i = 0; $i < $count; $i++)
				<td></td>
			@endfor
			<td>{{ implode('', $dividends_data["total_tax_dividends_sum"]) }}</td>
		</tr>
		<tr>
			<td>Net In Pocket</td>
			<td>{{ implode('<td></td>', $dividends_data["net_in_pocket"]) }}</td>
		</tr>
</tbody>
</table>
