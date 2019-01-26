@extends('layouts.main')
@section('title', 'System Logs - Admin')
	 
@section('content')

<div class="page-header">
	<h4 class="page-title">System Logs</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">System Logs</li>
	</ol>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="row">
			<div class="col-sm-3 col-md-2">
				<div class="list-group">
					@foreach($files as $file)
						<a href="?l={{ base64_encode($file) }}" class="list-group-item list-group-item list-group-item-action flex-column align-items-start @if ($current_file == $file) active @endif">{{$file}}</a>
					@endforeach
				</div>
			</div>
			<div class="col-sm-9 col-md-10">
				<div class="card">
					<div class="card-body">
						@if ($logs === null)
							<div>Log file >50M, please download it.</div>
						@else
							<table id="table-log" class="table table-striped table-bordered dataTable no-footer">
								<thead>
									<tr>
										<th>Level</th>
										<th>Context</th>
										<th>Date</th>
										<th>Content</th>
									</tr>
								</thead>
								<tbody>
									@foreach($logs as $key => $log)
										<tr>
											<td class="text-{{{$log['level_class']}}}"><span class="fas fa-exclamation-triangle" aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
											<td class="text">{{$log['context']}}</td>
											<td class="date">{{ ucfirst(\Carbon::parse($log['date'])->isoFormat('LLL')) }}</td>
											<td class="text">
												@if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs" data-display="stack{{{$key}}}"><span class="fas fa-search"></span></a>@endif
												{{{$log['text']}}}
												@if (isset($log['in_file'])) <br />{{{$log['in_file']}}}@endif
												@if ($log['stack']) <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}</div>@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@endif
						<div>
							@if($current_file)
								<a href="?dl={{ base64_encode($current_file) }}"><span class="fas fa-download"></span> Download file</a>
								-
								<a id="delete-log" href="?del={{ base64_encode($current_file) }}"><span class="fas fa-trash"></span> Delete file</a>
								@if(count($files) > 1)
									-
									<a id="delete-all-log" href="?delall=true"><span class="fas fa-trash"></span> Delete all files</a>
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('css')
	<link href="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('plugins/datatable/responsive/css/responsive.bootstrap4.css') }}" rel="stylesheet">
@stop
@section('javascript')
	<script src="{{ Theme::url('plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/responsive/js/datatables.responsive.min.js') }}"></script>
	<script src="{{ Theme::url('plugins/datatable/responsive/js/responsive.bootstrap4.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table-log').DataTable({
				"order": [ 1, 'desc' ],
				"stateSave": true,
				responsive: true,
				"stateSaveCallback": function (settings, data) {
					window.localStorage.setItem("datatable", JSON.stringify(data));
				},
				"stateLoadCallback": function (settings) {
					var data = JSON.parse(window.localStorage.getItem("datatable"));
					if (data) data.start = 0;
					return data;
				}
			});
			$('.table-container').on('click', '.expand', function(){
				$('#' + $(this).data('display')).toggle();
			});
			$('#delete-log, #delete-all-log').click(function(){
				return confirm('Are you sure?');
			});
		});
	</script>
@stop