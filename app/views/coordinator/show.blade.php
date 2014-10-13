@extends('layouts/coordinator')

@section('content')

<style>

.coordinator-control {
	width: 150px;
}

#coords-display-dash .coord-set-display:first-child {
	margin-right: 20px;
}
#coords-display-dash {
	padding-top: 10px;
}
.dashboard-info {
	display: inline;
}
#last-saved {
	margin-left: 20px;
}
#undo-link {
	font-size: 12px;
	cursor: pointer;
}

</style>

<div class="container">

	<div class="coordinator-hud">

		<button type="button" class="btn btn-default coordinator-control" id="prepare">Prepare</button>
		<button type="button" class="btn btn-default coordinator-control" id="save">Save</button>
		<button type="button" class="btn btn-default coordinator-control" id="clear">Clear</button>

	</div>
	<div id="coords-display-dash">

		<div class="coord-set-display dashboard-info">
			<p class="dashboard-info"><i><b>x1</b>:&nbsp;<span id="x1_coord">"0"</span></i></p>
			<p class="dashboard-info"><i><b>y1</b>:&nbsp;<span id="y1_coord">"0"</span></i></p>
		</div>

		<div class="coord-set-display dashboard-info">
			<p class="dashboard-info"><i><b>x2</b>:&nbsp;<span id="x2_coord">"0"</span></i></p>
			<p class="dashboard-info"><i><b>y2</b>:&nbsp;<span id="y2_coord">"0"</span></i></p>
		</div>

		<div class="coord-set-display dashboard-info">
			<p class="dashboard-info" id="last-saved">
				<i>Last saved seat:&nbsp;<span>"0", "0", "0", "0"</span></i>&nbsp;
				<a class="text-warning" id="undo-link">Undo last seat</a>
			</p>
		</div>

	</div>

</div><!-- /.container -->

<img src="{{ $map->draw(true)->output() }}" alt="map" id="canvas-image">

<script>


var click = 0;
var shape = new Object();
shape.prepared = false;
shape.set = false;

var last_saved; // contains the ID of the last saved seat coordinates

// Prepares the map image to be clicked on to generate coordinate locations for seats
// to be saved to the database for use with the rest of the application
function prepare()
{
	shape.x1 = null;
	shape.y1 = null;
	shape.x2 = null;
	shape.y2 = null;
	click = 0;

	$('#prepare').attr('disabled', 'disabled');
	$('#canvas-image').css('cursor', 'crosshair');

	shape.prepared = true;
	shape.set = false;
}

// Called via the "Clear" button. Clears mal-designated coordinates.
// Resets prepare button to a clickable state to prepare for coordinate re-entry.
function clear_app()
{
	$('#x1_coord').text('"0"');
	$('#y1_coord').text('"0"');
	$('#x2_coord').text('"0"');
	$('#y2_coord').text('"0"');

	$('#prepare').removeAttr('disabled');
	$('#canvas-image').css('cursor', 'default');

	shape.prepared = false;
	shape.set = false;
	click = 0;
}

// Called when ready to save coordinates as seat in the database
// for the application.
function save()
{
	if( ! shape.set) return;

	// if rectangle was drawn in reverse
	if(shape.x1 > shape.x2)
	{
		// Re-order coordinates
		x1 = shape.x2;
		x2 = shape.x1;
		shape.x1 = x1;
		shape.x2 = x2;
	}

	var map_id = "{{ $map->id }}";
	$.ajax({
		url: "{{ URL::to('coordinator/save') }}",
		type: 'GET',
		data: {x1: shape.x1, y1: shape.y1, x2: shape.x2, y2: shape.y2, map_id: map_id},
		dataType: 'json'
	}).done(function(data) {
		console.log(data);
		last_saved = data.seat_id;

		$('#canvas-image').attr('src', data.map_src);
		$('#last-saved span').text('"'+data.seat.x1+'"'+', '+'"'+data.seat.y1+'"'+', '+'"'+data.seat.x2+'"'+', '+'"'+data.seat.y2+'"');

		clear_app();
	});
}

function undo()
{
	$.ajax({
		url: "{{ URL::to('coordinator/undo') }}",
		type: 'GET',
		data: {seat_id: last_saved},
		dataType: 'json'
	}).done(function(data) {
		console.log(data);

		$('#canvas-image').attr('src', data.map_src);
	});
}

// Attach click events to the control buttons
$('#prepare').click(function() { prepare() });
$('#clear').click(function() { clear_app() });
$('#save').click(function() { save() });

$('#undo-link').click(function() { undo() });

$('#canvas-image').click(function(e) {

	if( ! shape.prepared) return;

	var scrollTop = $(document).scrollTop();
	var scrollLeft = $(document).scrollLeft();

	x = (e.clientX - $(this).offset().left) + scrollLeft;
	y = (e.clientY - $(this).offset().top) + scrollTop;

	// testing mouse coords
	// console.log('(CLICK)');
	// console.log('----------------------');
	// console.log('x=' + x);
	// console.log('y=' + y);
	// console.log('----------------------');

	if(click === 0)
	{
		shape.x1 = x;
		shape.y1 = y;

		$('#x1_coord').text(shape.x1);
		$('#y1_coord').text(shape.y1);
	}
	else if(click === 1)
	{
		shape.x2 = x;
		shape.y2 = y;

		$('#x2_coord').text(shape.x2);
		$('#y2_coord').text(shape.y2);

		shape.set = true;
	}
	click++;
});


$(document).ready(function() {
	console.log('Left offset: ' + $('#canvas-image').offset().left);
	console.log('Top offset: ' + $('#canvas-image').offset().top);
});

$(document).keypress(function(e) {
	if(e.keyCode === 114)
	{
		// Prepare
		prepare();
	}
	else if(e.keyCode === 115)
	{
		// Save
		save();
	}
	else if(e.keyCode === 99)
	{
		// Clear
		clear_app();
	}
	else if(e.keyCode === 117)
	{
		// Undo
		undo();
	}
});

</script>

@stop