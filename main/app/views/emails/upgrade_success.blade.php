<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			Hello {{ $user->mh2_fname }},
		</div>
		<br/>
		<div>
			You are now a '{{ $user->getMembershipLevelDisplayAttribute() }}' member.
			Thank you for deciding to upgrade your membership in PracticePro.
		</div>
		<br/>
		<div>
			Best regards
		</div>
	</body>
</html>
