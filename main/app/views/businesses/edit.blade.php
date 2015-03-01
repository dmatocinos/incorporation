@extends('layouts.scaffold')

@section('main')

<h1>Edit Business</h1>
{{ Form::model($business, array('method' => 'PATCH', 'route' => array('businesses.update', $business->id))) }}
	<ul>
        <li>
            {{ Form::label('business_entity', 'Business_entity:') }}
            {{ Form::text('business_entity') }}
        </li>

        <li>
            {{ Form::label('net_profit_before_tax', 'Net_profit_before_tax:') }}
            {{ Form::text('net_profit_before_tax') }}
        </li>

        <li>
            {{ Form::label('amount_to_distribute', 'Amount_to_distribute:') }}
            {{ Form::text('amount_to_distribute') }}
        </li>

        <li>
            {{ Form::label('fee_based_on_tax_saved', 'Fee_based_on_tax_saved:') }}
            {{ Form::text('fee_based_on_tax_saved') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('businesses.show', 'Cancel', $business->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
