@extends('layouts.scaffold')

@section('main')

<h1>Show Business</h1>

<p>{{ link_to_route('businesses.index', 'Return to all businesses') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Business_entity</th>
				<th>Net_profit_before_tax</th>
				<th>Amount_to_distribute</th>
				<th>Fee_based_on_tax_saved</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $business->business_entity }}}</td>
					<td>{{{ $business->net_profit_before_tax }}}</td>
					<td>{{{ $business->amount_to_distribute }}}</td>
					<td>{{{ $business->fee_based_on_tax_saved }}}</td>
                    <td>{{ link_to_route('businesses.edit', 'Edit', array($business->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('businesses.destroy', $business->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
