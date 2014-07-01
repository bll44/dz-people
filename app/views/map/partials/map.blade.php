<h3>{{ ucwords($map->company) . ' ' . ucwords($map->location) . ', ' . $map->floor }}</h3>

<img src="{{ $image }}" class="map-img" usemap="#seat-map">

<map name="seat-map">
<?php

foreach($map->seats as $seat)
{
	$x1 = round($seat->x1 * $map->getScale());
	$y1 = round($seat->y1 * $map->getScale());
	$x2 = round($seat->x2 * $map->getScale());
	$y2 = round($seat->y2 * $map->getScale());

	switch ($mode) {

		case 'seatChange' :

		if(is_null($seat->user_id))
		{
			$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
			$element .= " title='Empty' href='";
			$element .= URL::to("seat/{$seat->id}?user={$user->objectguid}");
			$element .= "'>";
		}
		else
		{
			$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
			$element .= " title='{$seat->user->displayname}'>";
		}

		break;

		default :

		if(is_null($seat->user_id))
			$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'>";
		else
		{
			$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
			$element .= " title='{$seat->user->displayname}'";
			$element .= " href='";
			$element .= URL::to("profile/{$seat->user_id}");
			$element .= "'>";
		}

		break;
	}
	echo $element;
}

?>
</map>

<script>

$("area").qtip({
    position: {
        my: 'top left'
    }
});

</script>