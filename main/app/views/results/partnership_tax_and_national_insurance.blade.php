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
			@foreach ($partnership_data["taxable_tax"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
    
    <?php $num_rows = 0; ?>
    
	@for ($i = 1; $i <= 4; $i++)
        <?php $all_zeros = true; ?>
            
        @foreach ($partnership_data["tax_due_{$i}"] as $value)
            @if ($value != '0')
                <?php 
                    $all_zeros = false;
                    break;
                ?>
            @endif
        @endforeach
        
        @if ($all_zeros == true)
            <?php continue; ?>
        @endif
        
        <?php $num_rows++; ?>
        
		<tr>
			<td>{{ ($num_rows == 1) ? 'Tax Due' : ''}}</td>
			@foreach ($partnership_data["tax_due_{$i}"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@endfor
    
    @if ($num_rows == 0)
        <tr>
            <td>{{ 'Tax Due' }}</td>
            <?php $i = 1 ?>
            @foreach ($partnership_data["tax_due_{$i}"] as $value)
                <td> {{ $value }}</td>
            @endforeach
        </tr>
    @endif
    
		<tr>
			<td>Taxable (N.I.)</td>
			@foreach ($partnership_data["taxable_ni"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
    
    <?php $num_rows = 0; ?>
    
	@for ($i = 1; $i <= 2; $i++)
        <?php $all_zeros = true; ?>
            
        @foreach ($partnership_data["ni_due_{$i}"] as $value)
            @if ($value != '0')
                <?php 
                    $all_zeros = false;
                    break;
                ?>
            @endif
        @endforeach
        
        @if ($all_zeros == true)
            <?php continue; ?>
        @endif
        
        <?php $num_rows++; ?>
        
		<tr>
			<td>{{ ($num_rows == 1) ? 'N.I. Due' : ''}}</td>
			@foreach ($partnership_data["ni_due_{$i}"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@endfor
    
    @if ($num_rows == 0)
        <tr>
            <td>{{ 'N.I. Due' }}</td>
            <?php $i = 1 ?>
            @foreach ($partnership_data["ni_due_{$i}"] as $value)
                <td> {{ $value }}</td>
            @endforeach
        </tr>
    @endif
    
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="active">
			<td>Total Tax ({{ $business->business_entity == 'Partnership' ? 'Partnership' : 'Sole Trader' }})</td>
			@foreach ($partnership_data["total_tax_partnership"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<tr>
			@for ($i = 0; $i < $count; $i++)
				<td></td>
			@endfor
			<td>{{ implode('<td></td>', $partnership_data["total_tax_partnership_sum"]) }}</td>
		</tr>
</tbody>
</table>
