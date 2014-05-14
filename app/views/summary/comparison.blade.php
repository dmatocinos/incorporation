<?php $comparison_data_column = $business->isPartnership() ? 'partnership' : 'sole_trade'; ?>

<table class="table">
<thead>
	<tr>
		<th></th>
        <?php if ($business->business_entity == 'Partnership') : ?>
        <th>Partnership</th>
        <?php else : ?>
		<th>Sole Trader</th>
		<?php endif; ?>
		<th>Limited Company</th>
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
        
        <td>{{ $comparison_data2['corporation_tax'][$comparison_data_column] }}</td>
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
        
        <td>{{ $comparison_data2['income_tax'][$comparison_data_column] }}</td>
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
        
        <td>{{ $comparison_data2['employer'][$comparison_data_column] }}</td>
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
        
        <td>{{ $comparison_data2['employee'][$comparison_data_column] }}</td>
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
        
        <td>{{ $comparison_data2['total_to_hmrc'][$comparison_data_column] }}</td>
	</tr>

	<tr>
		<td colspan="100%">&nbsp;</td>
	<tr>
    
    @if ($business->isPartnership())
    <tr class="success">
		<th>Net in Pocket (per Partner)</th>
		<td>N/A</td>
		<td>{{ $comparison_data2['net_in_pocket'][$comparison_data_column] }}</td>
	</tr>
	<tr class="success">
		<th>Net in Pocket (Total)</th>
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
        
        <td>{{ $comparison_data2['net_in_pocket_total'][$comparison_data_column] }}</td>
	</tr>
    @else
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
        
        <td>{{ $comparison_data2['net_in_pocket'][$comparison_data_column] }}</td>
	</tr>
    @endif
</tbody>
</table>
