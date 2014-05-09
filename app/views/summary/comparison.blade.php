<table class="table">
<thead>
	<tr>
		<th></th>
        <?php if ($business->business_entity == 'Partnership') : ?>
        <th>Partnership</th>
        <?php else : ?>
		<th>Sole Trader</th>
		<?php endif; ?>
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
		@foreach ($comparison_data['corporation_tax'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
        <td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<td>Income Tax</td>
		@foreach ($comparison_data['income_tax'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
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
		@foreach ($comparison_data['employer'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<td>Employee's</td>
		@foreach ($comparison_data['employee'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="danger">
		<th>TOTAL TO HMRC</th>
		@foreach ($comparison_data['total_to_hmrc'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="success">
		<th>Net in Pocket</th>
		@foreach ($comparison_data['net_in_pocket'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>
	<tr>
		<th>Left in the Company</th>
		@foreach ($comparison_data['left_in_company'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>

	<tr class="success">
		<th>AMOUNT RETAINED</th>
		@foreach ($comparison_data['amount_retained'] as $column => $tax)
        <?php 
            if ($business->business_entity == 'Partnership') {
                if ($column == 'sole_trade') {
                    continue;
                }
            }
            else {
                if ($column == 'partnership') {
                    continue;
                }
            }
        ?>
		<td>{{ $tax }}</td>
		@endforeach
	</tr>

</tbody>
</table>
