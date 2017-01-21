<div class="content">
    <div class="title">Something went wrong.</div>
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
</div>