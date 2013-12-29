@extends('layouts.scaffold')

@section('main')

<h1>All Options</h1>

<p>{{ link_to_route('options.create', 'Add new option') }}</p>

@if ($options->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Higher_dividend_threshold_j</th>
				<th>Higher_dividend_threshold_k</th>
				<th>Dividend_threshold_i</th>
				<th>Dividend_threshold_j</th>
				<th>Dividend_threshold_k</th>
				<th>Corporate_tax_rate_j</th>
				<th>Corporate_tax_rate_k</th>
				<th>Main_rate</th>
				<th>Employees_ni_i</th>
				<th>Employees_ni_j</th>
				<th>Employees_ni_k</th>
				<th>Employees_ni_l</th>
				<th>Employers_ni_j</th>
				<th>Employers_ni_k</th>
				<th>Income_tax_and_ni_i</th>
				<th>Income_tax_and_ni_j</th>
				<th>Income_tax_and_ni_k</th>
				<th>Income_tax_and_ni_l</th>
				<th>J8</th>
				<th>K8</th>
				<th>J9</th>
				<th>K9</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($options as $option)
				<tr>
					<td>{{{ $option->higher_dividend_threshold_j }}}</td>
					<td>{{{ $option->higher_dividend_threshold_k }}}</td>
					<td>{{{ $option->dividend_threshold_i }}}</td>
					<td>{{{ $option->dividend_threshold_j }}}</td>
					<td>{{{ $option->dividend_threshold_k }}}</td>
					<td>{{{ $option->corporate_tax_rate_j }}}</td>
					<td>{{{ $option->corporate_tax_rate_k }}}</td>
					<td>{{{ $option->main_rate }}}</td>
					<td>{{{ $option->employees_ni_i }}}</td>
					<td>{{{ $option->employees_ni_j }}}</td>
					<td>{{{ $option->employees_ni_k }}}</td>
					<td>{{{ $option->employees_ni_l }}}</td>
					<td>{{{ $option->employers_ni_j }}}</td>
					<td>{{{ $option->employers_ni_k }}}</td>
					<td>{{{ $option->income_tax_and_ni_i }}}</td>
					<td>{{{ $option->income_tax_and_ni_j }}}</td>
					<td>{{{ $option->income_tax_and_ni_k }}}</td>
					<td>{{{ $option->income_tax_and_ni_l }}}</td>
					<td>{{{ $option->j8 }}}</td>
					<td>{{{ $option->k8 }}}</td>
					<td>{{{ $option->j9 }}}</td>
					<td>{{{ $option->k9 }}}</td>
                    <td>{{ link_to_route('options.edit', 'Edit', array($option->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('options.destroy', $option->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no options
@endif

@stop
