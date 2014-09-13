@extends('layouts.master')

@section('content')

<style>

#profile-btn-hud-container input[type=submit] {
	width: 120px;
}

</style>

<div class="row">

	<div class="col-md-12">

		<div class="col-sm-2">
			{{ HTML::image('images/profiles/no_photo.jpg',
				'Profile Picture',
				['style' => 'width: 165px; height: 210px;']) }}
		</div><!-- /image container -->

		<div id="profile-info-container" class="col-sm-5">

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

			</ul><!-- /.list-group -->

		</div><!-- /#profile-info-container -->

		@if(Session::get('logged_in_user')->admin)
		<div id="profile-btn-hud-container" class="col-sm-5">
			<p>
				@if( ! is_null($user->seat))
					{{ Form::open(['url' => 'seat/' . $user->objectguid . '/' . $user->seat->map->id . '/edit', 'method' => 'get']) }}
					{{ Form::submit('Change Seat', ['class' => 'btn btn-sm btn-primary']) }}
					{{ Form::close() }}
				@endif
			</p>

			@if( ! is_null($user->seat))
			<p>
				{{ Form::open(['route' => ['seat.destroy', $user->objectguid], 'method' => 'delete']) }}
				{{ Form::submit('Remove Seat', ['class' => 'btn btn-sm btn-primary']) }}
				{{ Form::close() }}
			</p>
			@endif
		</div>
		@endif

	</div><!-- /.col-md-12 -->

</div><!-- /.row -->

@if(isset($image) && isset($seat))

<img src="{{ $image }}" class="map-img" usemap="#seat-map"/>

<map name="seat-map">
	<area shape="rect" coords="{{ $seat->x1 }}, {{ $seat->y1 }}, {{ $seat->x2 }}, {{ $seat->y2 }}">
</map><!-- /seat-map -->

@else

<div class="text-center no-seat">
	@if(Session::get('logged_in_user')->admin)
		<div>
			{{ Form::open(['url' => 'seat/' . $user->objectguid . '/1/edit', 'method' => 'get']) }}
			{{ Form::submit("Assign a Seat to {$user->firstname}", ['class' => 'btn btn-lg btn-primary']) }}
			{{ Form::close() }}
		</div>
	@else
		<h3>No Seat</h3>
	@endif
</div>

@endif

@stop






