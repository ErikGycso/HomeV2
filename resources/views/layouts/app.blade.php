<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ config('app.name', 'Dev') }}</title>

	<script src="https://kit.fontawesome.com/2c40af7f44.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="/css/materialize.min.css">
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/gycso/style.css">
	<link rel="icon" type="image/x-icon" href="/images/favicon.ico">

</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--header-->

		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content" data-app>
                    <!--Content-->
                    @yield('content')
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>


	</div>


	<!--plugins-->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>