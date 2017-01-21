@extends('layouts.main')
@section('title', '500')
   
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center">
			<h1 class="error-header">500</h1>
			<h3 class="error-lead text-muted">Oops! We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.</h3>
		</div>
	</div>
</div>
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
@stop