@extends('layouts.scaffold')

@section('main')

<h1>Create Partner</h1>

{{ Form::open(array('route' => 'partners.store')) }}
	<ul>
        <li>
            {{ Form::label('share', 'Share:') }}
            {{ Form::text('share') }}
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


