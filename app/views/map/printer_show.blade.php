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

</style>

<div class="pull-right profile-seat-btn-hud">
	<div>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#choose_map">Choose a Different Map</button>
	</div>
</div>

@include('map/partials/printerMap')


<div class="modal fade col-lg-12 col-md-12 col-sm-12 col-xs-12" id="choose_map">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Choose a Different Map</h4>
			</div>
			<div class="modal-body">

				<div id="map_thumb_wrapper"></div>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')

@if(isset($user))
<script>

$(document).ready(function() {
	var objGuid = "{{ $user->objectguid }}"
	$.ajax({
		url: "{{ URL::to('map/thumbs') }}",
		type: 'POST',
		data: { userId: objGuid }
	}).done(function(data) {
		$('#map_thumb_wrapper').html(data);
	});
});

</script>
@else
<script>

$(document).ready(function() {

	$.ajax({
		url: "{{ URL::to('map/thumbs') }}",
		type: 'POST',
		data: { userId: null }
	}).done(function(data) {
		$('#map_thumb_wrapper').html(data);
	});

});

</script>
@endif

@stop