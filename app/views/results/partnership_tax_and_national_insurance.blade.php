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
			<td>Taxable (Tax)</td>
			<td>{{ implode('<td></td>', $partnership_data["taxable_tax"]) }}</td>
		</tr>
	@for ($i = 4; $i <= 4; $i++)
		<tr>
			<td>{{ ($i == 1) ? 'Tax Due' : ''}}</td>
			<td>{{ implode('<td></td>', $partnership_data["tax_due_{$i}"]) }}</td>
		</tr>
	@endfor
		<tr>
			<td>Taxable (N.I.)</td>
			<td>{{ implode('<td></td>', $partnership_data["taxable_ni"]) }}</td>
		</tr>
	@for ($i = 1; $i <= 2; $i++)
		<tr>
			<td>{{ ($i == 1) ? 'N.I. Due' : ''}}</td>
			<td>{{ implode('<td></td>', $partnership_data["ni_due_{$i}"]) }}</td>
		</tr>
	@endfor
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="active">
			<td>Total Tax (Partnership)</td>
			<td>{{ implode('<td></td>', $partnership_data["total_tax_partnership"]) }}</td>
		</tr>
		<tr>
			@for ($i = 0; $i < $count; $i++)
				<td></td>
			@endfor
			<td>{{ implode('<td></td>', $partnership_data["total_tax_partnership_sum"]) }}</td>
		</tr>
</tbody>
</table>
