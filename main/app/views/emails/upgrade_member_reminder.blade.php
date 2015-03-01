<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			A memmber has upgraded his/her membership level.
		</div>
		<br/>
		<div>
			Please find the details below:
		</div>
		<br/>
		<div>
			Name: {{ $user->mh2_fname . " " . $user->mh2_lname}}
		</div>
		<br/>
		<div>
			Email: {{ $user->mh2_email}}
		</div>
		<br/>
		<div>
			Membership Type: {{ $user->getMembershipLevelDisplayAttribute() }}
		</div>
	</body>
</html>
