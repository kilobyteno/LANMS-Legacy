@extends('layouts.main')
@section('title', 'Broken Bands - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Broken Bands</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li class="active"><strong>Broken Bands</strong></li>
		</ol>

		<br />
		

		<br><hr><br>

		<div class="row">

			<div class="col-md-6">

				<h1 class="text-center">{{ BrokenBand::thisYear()->count() }}<br><small>Broken bands this year</small></h1>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>checkin_id</th>
							<th>previous_bandnumber</th>
							<th>new_bandnumber</th>
						</tr>
					</thead>
					<tbody>
						@foreach($brokenbands as $brokenband)	
							<tr>
								<td>{{ $brokenband->checkin_id }}</td>
								<td>{{ $brokenband->previous_bandnumber }}</td>
								<td>{{ $brokenband->new_bandnumber }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			

		</div>

	</div>
</div>

@stop