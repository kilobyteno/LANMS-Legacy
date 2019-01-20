@extends('layouts.main')
@section('title', trans('header.schedule'))
@section('content')
<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.schedule') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('header.schedule') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-body">
					@if(Setting::get('GOOGLE_CALENDAR_API_KEY') && Setting::get('GOOGLE_CALENDAR_ID'))
						<div id="calendar"></div>
					@else
						<p>{{ trans('global.nodata') }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('css')
	<link href="{{ Theme::url('plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
	<link href="{{ Theme::url('plugins/fullcalendar/fullcalendar.print.min.css') }}" rel="stylesheet" media="print" />
@stop

@section('javascript')
	<script src="{{ Theme::url('plugins/fullcalendar/moment.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/fullcalendar/gcal.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/fullcalendar/locale-all.js') }}"></script>
	@if(Setting::get('GOOGLE_CALENDAR_API_KEY') && Setting::get('GOOGLE_CALENDAR_ID') && Setting::get('GOOGLE_CALENDAR_START_DATE'))
		<script type="text/javascript">
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: '',
						center: 'title',
						right: ''
					},
					defaultView: 'agendaFourDay',
					views: {
						agendaFourDay: {
							type: 'agenda',
							duration: { days: 3 }
						}
					},
					defaultDate: '{{ Setting::get('GOOGLE_CALENDAR_START_DATE') }}',
					nowIndicator: true,
					allDaySlot: false,
					minTime: '07:00:00',
					slotDuration: '00:15:00',
					firstDay: 1,
					locale: '{{ \Session::get('locale') ?? 'en' }}',
					googleCalendarApiKey: '{{ Setting::get('GOOGLE_CALENDAR_API_KEY') }}',
					events: {
						googleCalendarId: '{{ Setting::get('GOOGLE_CALENDAR_ID') }}'
					}
				});
			});
		</script>
	@endif
@stop