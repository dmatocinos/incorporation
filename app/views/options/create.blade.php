@extends('layouts.scaffold')

@section('main')

<h1>Create Option</h1>

{{ Form::open(array('route' => 'options.store')) }}
	<ul>
        <li>
            {{ Form::label('higher_dividend_threshold_j', 'Higher_dividend_threshold_j:') }}
            {{ Form::text('higher_dividend_threshold_j') }}
        </li>

        <li>
            {{ Form::label('higher_dividend_threshold_k', 'Higher_dividend_threshold_k:') }}
            {{ Form::text('higher_dividend_threshold_k') }}
        </li>

        <li>
            {{ Form::label('dividend_threshold_i', 'Dividend_threshold_i:') }}
            {{ Form::text('dividend_threshold_i') }}
        </li>

        <li>
            {{ Form::label('dividend_threshold_j', 'Dividend_threshold_j:') }}
            {{ Form::text('dividend_threshold_j') }}
        </li>

        <li>
            {{ Form::label('dividend_threshold_k', 'Dividend_threshold_k:') }}
            {{ Form::text('dividend_threshold_k') }}
        </li>

        <li>
            {{ Form::label('corporate_tax_rate_j', 'Corporate_tax_rate_j:') }}
            {{ Form::text('corporate_tax_rate_j') }}
        </li>

        <li>
            {{ Form::label('corporate_tax_rate_k', 'Corporate_tax_rate_k:') }}
            {{ Form::text('corporate_tax_rate_k') }}
        </li>

        <li>
            {{ Form::label('main_rate', 'Main_rate:') }}
            {{ Form::text('main_rate') }}
        </li>

        <li>
            {{ Form::label('employees_ni_i', 'Employees_ni_i:') }}
            {{ Form::text('employees_ni_i') }}
        </li>

        <li>
            {{ Form::label('employees_ni_j', 'Employees_ni_j:') }}
            {{ Form::text('employees_ni_j') }}
        </li>

        <li>
            {{ Form::label('employees_ni_k', 'Employees_ni_k:') }}
            {{ Form::text('employees_ni_k') }}
        </li>

        <li>
            {{ Form::label('employees_ni_l', 'Employees_ni_l:') }}
            {{ Form::text('employees_ni_l') }}
        </li>

        <li>
            {{ Form::label('employers_ni_j', 'Employers_ni_j:') }}
            {{ Form::text('employers_ni_j') }}
        </li>

        <li>
            {{ Form::label('employers_ni_k', 'Employers_ni_k:') }}
            {{ Form::text('employers_ni_k') }}
        </li>

        <li>
            {{ Form::label('income_tax_and_ni_i', 'Income_tax_and_ni_i:') }}
            {{ Form::text('income_tax_and_ni_i') }}
        </li>

        <li>
            {{ Form::label('income_tax_and_ni_j', 'Income_tax_and_ni_j:') }}
            {{ Form::text('income_tax_and_ni_j') }}
        </li>

        <li>
            {{ Form::label('income_tax_and_ni_k', 'Income_tax_and_ni_k:') }}
            {{ Form::text('income_tax_and_ni_k') }}
        </li>

        <li>
            {{ Form::label('income_tax_and_ni_l', 'Income_tax_and_ni_l:') }}
            {{ Form::text('income_tax_and_ni_l') }}
        </li>

        <li>
            {{ Form::label('j8', 'J8:') }}
            {{ Form::text('j8') }}
        </li>

        <li>
            {{ Form::label('k8', 'K8:') }}
            {{ Form::text('k8') }}
        </li>

        <li>
            {{ Form::label('j9', 'J9:') }}
            {{ Form::text('j9') }}
        </li>

        <li>
            {{ Form::label('k9', 'K9:') }}
            {{ Form::text('k9') }}
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


