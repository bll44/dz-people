@extends('layouts.master')

@section('content')

<style>

</style>


<div class="row">

	<div>
		{{ HTML::image('images/profiles/no_photo.jpg', 'Profile Picture', ['class' => 'col-lg-2 col-md-2 hidden-sm hidden-xs']) }}
	</div>
	<!-- /image container -->

	<div id="profile-info-container" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<ul class="list-group">

			<li class="list-group-item text-muted"><b>{{ $user->displayname }}</b></li>
			<li class="list-group-item text-right">
				<span class="pull-left">
					<strong>Company</strong>
				</span>
				{{ strlen($user->company) > 0 ? $user->company : 'N/A' }}
			</li>
			<li class="list-group-item text-right">
				<span class="pull-left">
					<strong>Department</strong>
				</span>
				{{ strlen($user->department) > 0 ? $user->department : 'N/A' }}
			</li>
			<li class="list-group-item text-right">
				<span class="pull-left">
					<strong>Title</strong>
				</span>
				{{ strlen($user->title) > 0 ? $user->title : 'N/A' }}
			</li>
			<li class="list-group-item text-right">
				<span class="pull-left">
					<strong>Years with Company</strong>
				</span>
				{{ Dates::getYearsExperience($user->start_date) }}
			</li>
			<li class="list-group-item text-right">
				<span class="pull-left">
					<strong>Phone</strong>
				</span>
				{{ $user->phone }}
			</li>
			<!-- end list items -->
		</ul>
		<!-- /.list-group -->
	</div>
	<!-- /#profile-info-container -->

	@if(Session::get('logged_in_user')->admin)

		<div id="profile-btn-hud-container" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="row">
				<div class="profile-btn-container">
					<p>
						@if( ! is_null($user->seat))

						{{ Form::open(['url' => 'seat/' . $user->objectguid . '/' . $user->seat->map->id . '/edit', 'method' => 'get']) }}
						{{ Form::submit('Change Seat', ['class' => 'btn btn-sm btn-primary col-lg-8 col-md-10 col-sm-offset-1 col-xs-offset-1 col-md-offset-0 col-lg-offset-0 col-sm-10 col-xs-10']) }}
						{{ Form::close() }}
						@endif
					</p>
				</div>
				<!-- /.profile-btn-container -->
			</div>
			<!-- /.row -->
			@if( ! is_null($user->seat))
			<div class="row">
				<div class="profile-btn-container">
					<p>
						{{ Form::open(['route' => ['seat.destroy', $user->objectguid], 'method' => 'delete']) }}
						{{ Form::submit('Remove Seat', ['class' => 'btn btn-sm btn-primary col-lg-8 col-md-10 col-sm-offset-1 col-xs-offset-1 col-md-offset-0 col-lg-offset-0 col-sm-10 col-xs-10']) }}
						{{ Form::close() }}
					</p>
				</div>
				<!-- /.profile-btn-container -->
			</div>
			<!-- /.row -->
			@endif
		</div>
		<!-- /#profile-btn-hud-container -->
	@endif
</div>
<!-- /.row -->




@if(isset($image) && isset($seat))

	<div class="row">

		<img src="{{ $image }}" class="map-img" usemap="#seat-map"/>

		<map name="seat-map">
			<area shape="rect" coords="{{ $seat->x1 }}, {{ $seat->y1 }}, {{ $seat->x2 }}, {{ $seat->y2 }}">
		</map><!-- /seat-map -->

		@else

		<div class="text-center no-seat">
			@if(Session::get('logged_in_user')->admin && is_null($user->seat))
				<div>
					{{ link_to("seat/{$user->objectguid}/1/edit/seatChange", "Assign a seat to {$user->firstname}", ['class' => 'btn btn-lg btn-primary']) }}
				</div>
			@else
				@if(is_null($user->seat))
					<h3>No Seat</h3>
				@endif
			@endif
		</div>

	</div>
	<!-- /.row -->
@endif

@stop






