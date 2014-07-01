@extends('layouts.master')


@section('content')

<style>

#test-img {
	width: 900px;
}

</style>

<div>

<img src="data:image/png;base64,{{ $image }}" usemap="#seat-map" id="test-img">

</div>

<map name="seat-map">
<?php

$x1 = round(192 * $scale);
$y1 = round(82 * $scale);
$x2 = round(300 * $scale);
$y2 = round(180 * $scale);

?>
<area shape="rect" coords="{{ $x1 }}, {{ $y1 }}, {{ $x2 }}, {{ $y2 }}" href="#">
<area shape="rect" coords="266, 317, 398, 447" href="#">
<area shape="rect" coords="421, 160, 554, 273" href="#">
<area shape="rect" coords="671, 296, 794, 473" href="#">
</map>

<script>

console.log('Width: ' + $("#test-img").width());
console.log('Height: ' + $("#test-img").height());

</script>

@stop