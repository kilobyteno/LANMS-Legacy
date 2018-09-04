@if(Session::has('message') && Session::has('messagetype'))
	<div class="alert alert-{{ Session::get('messagetype') }}" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		@if(Session::get('messagetype') == 'info')
			<i class="fas fa-bell mr-2" aria-hidden="true"></i>
		@elseif(Session::get('messagetype') == 'warning')
			<i class="fas fa-exclamation mr-2" aria-hidden="true"></i>
		@elseif(Session::get('messagetype') == 'danger')
			<i class="fas fa-frown mr-2" aria-hidden="true"></i>
		@elseif(Session::get('messagetype') == 'success')
			<i class="fas fa-check-circle mr-2" aria-hidden="true"></i>
		@endif
		{{ Session::get('message') }}
	</div>
@endif

