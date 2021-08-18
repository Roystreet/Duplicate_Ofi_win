<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://kit.fontawesome.com/ee1e499696.js" crossorigin="anonymous"	 integrity="sha384-p7JrABPXxZLpj1XoHTzkPyVs8ekVssRFXc4B7XU6Z1c8XVDA7sVPem/lQ9UouxqE"></script>

		<link rel="stylesheet" type="text/css" href="https://{{$system_domain}}/css/xflow.css">

		<script src="https://{{$system_domain}}/js/xflow/remote.js"></script>
		<script src="https://{{$system_domain}}/js/xflow/x.min.js"></script>

	</head>
	<body style="background-color: transparent">
		<div class="col-md-8">
			<div id="downline_profile_div" class="xflow-widget" style="width: 100%; height:600px;"
				data-status="active"
				data-menu="downline"
				data-action="profile"
				data-spinner=""
				data-post="_un=bob&structure=1">
			</div>

		</div>
		<script>
			window.is_app = true;
			$(document).ready(function() {
          XFlow.widget.remote({{$signed_login_url}});
			});
		</script>
	</body>
</html>
