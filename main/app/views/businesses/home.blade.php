@extends('layouts.authorized')

@section('title')
Home
@stop

@section('content')
	<div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> My Businesses</h3>
              </div>
              <div class="panel-body">
				<div class="valuations-list-div">
					<table id="business-list" style="float: left; width: 100%;">
						<thead>
							<tr>
								<th style="width: 40px !important;"></th>
								<th>Business Entity</th>
								<th>Net Profit Before Tax</th>
								<th>Fee Base (%)</th>
								<th>Created At</th>
								<th style="width: 40px !important;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($businesses as $business)
								<tr style="">
									<td class="center"><a class="btn btn-primary btn-sm" href="{{ url('/business/' . $business->id) }}"><i class="fa fa-edit"></i></a></td>
									<td>{{ $business->business_entity }}</td>
									<td>{{ $business->net_profit_before_tax }}</td>
									<td>{{ $business->fee_based_on_tax_saved }}</td>
									<td>{{ $business->created_at }}</td>
									<td class="center"><a class="delete-business btn btn-danger btn-sm" href="{{ url('/delete/' . $business->id) }}"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
        </div><!-- /.row -->		
@stop
