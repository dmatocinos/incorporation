<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			<p>New product recommendation from Incorporation Planner Pro<p>
			<table>
				<tr>
					<td style="font-weight: bold;">Accountant:</td>
					<td>
						{{ sprintf("%s %s - (%s)", $user->mh2_fname, $user->mh2_lname, $user->mh2_email) }}
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Client:</td>
					<td>{{ $client->business_name }} - {{ ($client->email) }}</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Client Net Profit:</td>
					<td>{{ $business->net_profit_before_tax }}</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Product Commission:</td>
					<td>{{ $user->getProductCommission() * 100}}%</td>
				</tr>
			</table>
		</div>
	</body>
</html>
