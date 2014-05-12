<?php $count = 0; ?>
<table class="table">
	<thead>
		<th></th>
	@foreach ($business->partners as $partner)
		<th>Partner {{ ++$count }}</th>
	@endforeach
	</thead>
	<tbody>
    
    <?php $num_rows = 0; ?>
    
	@for ($i = 1; $i <= 5; $i++)
        <?php $all_zeros = true; ?>
        @foreach ($salary_data["taxable_tax_{$i}"] as $value)
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
			<td>{{ ($num_rows == 1) ? 'Taxable (Tax)' : ''}}</td>
			@foreach ($salary_data["taxable_tax_{$i}"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@endfor
    
    @if ($num_rows == 0)
        <tr>
            <td>{{ 'Taxable (Tax)' }}</td>
            <?php $i = 1 ?>
            @foreach ($salary_data["taxable_tax_{$i}"] as $value)
                <td> {{ $value }}</td>
            @endforeach
        </tr>
    @endif
    
		<tr>
			<td>Taxable (N.I.)</td>
			@foreach ($salary_data["taxable_ni"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
    
    <?php $num_rows = 0; ?>
    
	@for ($i = 1; $i <= 2; $i++)
        <?php $all_zeros = true; ?>
            
        @foreach ($salary_data["ni_due_{$i}"] as $value)
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
			@foreach ($salary_data["ni_due_{$i}"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
	@endfor
    
    @if ($num_rows == 0)
        <tr>
            <td>{{ 'N.I. Due' }}</td>
            <?php $i = 1 ?>
            @foreach ($salary_data["ni_due_{$i}"] as $value)
                <td> {{ $value }}</td>
            @endforeach
        </tr>
    @endif
    
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr class="active">
			<td>Total Tax (Ltd Co)</td>
			@foreach ($salary_data["total_tax_ltd_co"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
		<!--
		<tr>
			@for ($i = 0; $i < $count; $i++)
				<td></td>
			@endfor
			<td>{{ implode('<td></td>', $salary_data["total_tax_ltd_co_sum"]) }}</td>
		</tr>
		-->
		<tr>
			<td>Net In Pocket</td>
			@foreach ($salary_data["net_in_pocket"] as $value)
				<td> {{ $value }}</td>
			@endforeach
		</tr>
</tbody>
</table>
