@extends('layouts.main')
@section('title', trans('header.schedule'))
@section('content')

<div class="container">
	<div class="page-header">
		<h4 class="page-title">{{ trans('header.schedule') }}</h4>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('header.home') }}</a></li>
			<li class="breadcrumb-item">{{ trans('header.information') }}</li>
			<li class="breadcrumb-item active" aria-current="page">{{ trans('header.schedule') }}</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-body">
					 <div id="calendar"></div>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: '',
					center: 'title',
					right: ''
				},
				defaultView: 'agendaWeek',
				defaultDate: '2019-02-25',
				nowIndicator: true,
				firstDay: 1,
				locale: 'nb',
				googleCalendarApiKey: 'AIzaSyAgroQkh7OwGrv3ZnMJzKinX2Pl5moDd5E',
				events: {
					googleCalendarId: 'post@downlinkdg.no'
				}
			});
		});
	</script>
@stop