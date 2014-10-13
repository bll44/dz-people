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

					@include('map.partials.modalThumbs')

				</div>
				<!-- /.map_thumb_wrapper -->
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')



@stop