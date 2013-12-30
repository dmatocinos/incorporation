@extends('layouts.authorized')

@section('title')
Salary In Limited Co
@stop

<?php $count = 0; ?>

@section('content')
<table class="table">
	<thead>
		<th></th>
	@foreach ($partners as $partner)
		<th>Partner {{ ++$count }}</th>
	@endforeach
	</thead>
	<tbody>
	@foreach ($salary_route as $row_name => $row_data)
		<tr>
			<td>{{ $row_name }}</td>
			<td>{{ implode('</td><td>', $row_data) }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
@stop
