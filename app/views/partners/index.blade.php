@extends('layouts.scaffold')

@section('main')

<h1>All Partners</h1>

<p>{{ link_to_route('partners.create', 'Add new partner') }}</p>

@if ($partners->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Share</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($partners as $partner)
				<tr>
					<td>{{{ $partner->share }}}</td>
                    <td>{{ link_to_route('partners.edit', 'Edit', array($partner->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('partners.destroy', $partner->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no partners
@endif

@stop
