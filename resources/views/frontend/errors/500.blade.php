<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<title>500</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #555;
				display: table;
				font-weight: 300;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 72px;
				margin-bottom: 40px;
			}

			.hero {
				font-size: 20px;
			}
			small {
				font-size:75%;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">500</div>
				<div class="hero">Oops! We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.</div>
			</div>
		</div>
	</body>
</html>
@unless(empty($sentryID))
	<!-- Sentry JS SDK 2.1.+ required -->
	<script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

	<script>
	Raven.showReportDialog({
		eventId: '{{ $sentryID }}',

		// use the public DSN (dont include your secret!)
		dsn: 'https://9456e021c68245d3a2dab66d95e6cf42@sentry.io/131026'
	});
	</script>
@endunless