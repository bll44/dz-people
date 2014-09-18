<h3>{{ ucwords($map->company_code) . ', ' . $map->floor }}</h3>

<img src="{{ $image }}" class="map-img" usemap="#seat-map">

<map name="seat-map">
<?php

foreach($map->seats as $seat)
{
	$x1 = round($seat->x1 * $map->getScale());
	$y1 = round($seat->y1 * $map->getScale());
	$x2 = round($seat->x2 * $map->getScale());
	$y2 = round($seat->y2 * $map->getScale());

	if(is_null($seat->printer_id))
	{
		$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
		$element .= " title='Empty' href='";
		$element .= URL::to("seat/{$seat->id}?printer={$printer->id}");
		$element .= "'>";
	}
	else
	{
		$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
		$element .= " title='{$seat->printer->name}'>";
	}
	echo $element;
}

?>
</map>

<script>

$(document).ready(function() {
	$("area").qtip({
	    position: {
	        my: 'top left'
	    }
	});
});

</script>