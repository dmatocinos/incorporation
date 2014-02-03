<div class="report-container">
	<div>1. Breakdown of your savings:</div>
	<div class="legend">Company</div>
	<br />
	<table cellspacing="3" cellpadding="3">
		<tbody>
			<tr>
				<td class="text-left" colspan="2">Goodwill savings obtained over {{ $business->goowill_write_of_years }} years</td>
				<td>£25,000</td>
				<td>{{ $data['possible_tax_savings']['possible_tax_savings_on_goodwill_amortised'] }}</td>
			</tr>
			<tr>
				<td class="text-left" colspan="2">Personal Capital gains tax due on goodwill sale</td>
				<td>10,380</td>
				<td>{{ $data['summary']['cost_in_cgt_on_business_partner'] }}</td>
			</tr>
			<tr>
				<td class="text-left" colspan="2">Dividend tax saved on extraction</td>
				<td>£31,250</td>
				<td>{{ $data['summary']['dividend_tax_saved_on_extraction'] }}</td>
			</tr>
			<tr>
				<td class="text-left" colspan="2">Net personal tax savings</td>
				<td>{{ $data['summary']['cost_in_cgt_on_business_partner'] - $data['summary']['dividend_tax_saved_on_extraction'] }}</td>
				<td></td>
			</tr>
			<tr >
				<td class="info text-left" colspan="2"><em>Overall savings (all Goodwil)</em></td>
				<td class="info">{{ $data['possible_tax_savings']['possible_tax_savings_on_goodwill_amortised'] - ($data['summary']['cost_in_cgt_on_business_partner'] + $data['summary']['dividend_tax_saved_on_extraction']) }}</td>
				<td class="info">{{ $data['summary']['overall_savings'] }}</td>
			</tr>
		</tbody>
	</table>
	<div> <p>Based upon our initial estimate of the value of your Goodwill, the tax savings for you will be estimated at £{{ $data['summary']['bpk_fee_for_capitalisation'] }}</p></div>


	<br/>
	<div>2. Summary of Accountants Fee:</div>
	<p>Our fee for saving you £{{ $data['summary']['overall_savings'] }} will be £{{ $data['summary']['bpk_fee_for_capitalisation'] }}.  If we are able to find even bigger tax savings as a result of our negotiations with HMRC, we will invoice you {{ ($business->fee_based_on_tax_saved / 100) }}% of the tax saved.  If we are not able to obtain this level of tax savings we will reduce our fee again to {{ ($business->fee_based_on_tax_saved / 100) }}%  of the tax saved.</p> 

<p>In order for work to commence a small initial payment on account of £500 + VAT will be payable; this payment on account will be deducted from the final fee due.</p>
	
	<p></p>
	<div>Acknowledgement</div>
	<p>Either party may terminate this Agreement at any time, for any reason, by giving 10 days written notice.  Any services that have not been paid for at that time will then be settled in full within 10 days.</p>
	<p></p>
	<div><p><h4>We would like to benefit from the services described within this report. We understand the benefits of the report and the associated costs; we authorise work to commence on the valuation of our goodwill and company assets:</h4></p></div>
	<p>Signed: _________________________<br /><em	>For and on behalf of: {{ $user->mh2_fname . $user->mh2_lname}}</em></p>
	<br />
	<p>Date: _____________________</p>
</div>
