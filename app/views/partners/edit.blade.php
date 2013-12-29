@extends('layouts.scaffold')

@section('main')

<h1>Edit Partner</h1>
{{ Form::model($partner, array('method' => 'PATCH', 'route' => array('partners.update', $partner->id))) }}
	<ul>
        <li>
            {{ Form::label('share', 'Share:') }}
            {{ Form::text('share') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('partners.show', 'Cancel', $partner->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
