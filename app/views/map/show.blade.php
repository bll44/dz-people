@extends('layouts.master')

@section('content')
<style>

.map-img {
	width: 1170px;
}

.profile-seat-btn-hud div {
	display: inline;
	padding: 0 5px;
}

area.printer:hover {
	cursor: pointer;
}

.clearfix {
	clear: both;
}

</style>

<div class="pull-right profile-seat-btn-hud">
	@if(isset($user))
		<div>
			{{ link_to("profile/{$user->objectguid}", 'Back to Profile') }}
		</div>
	@endif
	<div>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#choose_map">Choose a Different Map</button>
	</div>
</div>

@include('map/partials/map')


<div class="modal fade" id="choose_map">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Choose a Different Map</h4>
			</div>
			<div class="modal-body">
				<div class="map_thumb_wrapper clearfix">

					@foreach($allMaps as $m)

					<!-- <div class="row"> -->
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
							<div class="thumbnail">
								{{ HTML::image($m->image) }}
								<div class="caption">
									<h3>{{ $m->city.', '.$m->floor }}</h3>
									<p>{{ $m->description }}</p>
									<p>
										@if($viewMode ==='seatChange')
											{{ link_to("seat/{$user->id}/{$m->id}/edit/seatChange", 'View', ['role' => 'button', 'class' => 'btn btn-success']) }}
										@elseif($viewMode === 'overview')
											{{ link_to("map/{$m->id}/overview", 'View', ['role' => 'button', 'class' => 'btn btn-success']) }}
										@endif
									</p>
								</div>
								<!-- /.caption -->
							</div>
							<!-- /.thumbnail -->
						</div>
						<!-- /.column -->
					<!-- </div> -->
					<!-- /.row -->

					@endforeach

				</div>
				<!-- /.map_thumb_wrapper -->
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')



@stop