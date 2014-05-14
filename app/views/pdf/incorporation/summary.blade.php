<div class="report-container">
<h1>
Your Summary of Tax Savings
</h1>
<table class="table">
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
    <tr class="active">
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
<br>

@foreach ($graphs_data as $caption => $path)
<div class="row" style="width: 100%">
	<img style="width: 400px; padding-left: 300px;" src="{{ asset($path) }}" class="img-thumbnail"/>
</div>
@endforeach
</div>
