<table class="table">
<thead>
	<tr>
		<th></th>
        <?php if ($business->business_entity == 'Partnership') : ?>
        <th style="text-align: center;">Partnership</th>
        <?php else : ?>
		<th style="text-align: center;">Sole Trader</th>
		<?php endif; ?>
		<th style="text-align: center;">Limited Company</th>
        <th style="text-align: center;">Better off each year</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="100%">Tax</th>
	</tr>
	<tr>
		<td>Corporation Tax</td>
		<td class="number">{{ $comparison_data['entity']['corporation_tax'] }}</td>
		<td class="number">{{ $comparison_data['limited_company']['corporation_tax'] }}</td>
        <td></td>
	</tr>
	<tr>
		<td>Income Tax</td>
		<td class="number">{{ $comparison_data['entity']['income_tax'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['income_tax'] }}</td>
        <td></td>
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr>
		<th colspan="100%">National Insurance</th>
	</tr>
	<tr>
		<td>Class 2</td>
		<td class="number">{{ $comparison_data['entity']['class2'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['class2'] }}</td>
        <td></td>
	</tr>
    <tr>
		<td>Class 4</td>
		<td class="number">{{ $comparison_data['entity']['class4'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['class4'] }}</td>
        <td></td>
	</tr>
    <tr>
		<td>Employee's</td>
		<td class="number">{{ $comparison_data['entity']['employee'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['employee'] }}</td>
        <td></td>
	</tr>
    <tr>
		<td>Employer's</td>
		<td class="number">{{ $comparison_data['entity']['employer'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['employer'] }}</td>
        <td></td>
	</tr>
	
	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="danger">
		<th>TOTAL TO HMRC</th>
		<td class="number">{{ $comparison_data['entity']['total_to_hmrc'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['total_to_hmrc'] }}</td>
        <td></td>
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>
    <tr class="success">
		<th>Net in Pocket</th>
		<td class="number">{{ $comparison_data['entity']['net_in_pocket'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['net_in_pocket'] }}</td>
        <td class="number">{{ $comparison_data['better_off_each_year']['net_in_pocket'] }}</td>
	</tr>
    @if ($business->isPartnership())
    <tr>
		<td colspan="100%">&nbsp;</td>
	<tr>
    <tr class="success">
		<th>Net in Pocket per Partner</th>
		<td class="number">{{ $comparison_data['entity']['net_in_pocket_per_partner'] }}</td>
        <td class="number">{{ $comparison_data['limited_company']['net_in_pocket_per_partner'] }}</td>
        <td class="number">{{ $comparison_data['better_off_each_year']['net_in_pocket_per_partner'] }}</td>
	</tr>
    @endif
</tbody>
</table>
