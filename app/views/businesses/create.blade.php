@extends('layouts.scaffold')

@section('main')

<h1>Create Business</h1>

{{ Form::open(array('route' => 'businesses.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


