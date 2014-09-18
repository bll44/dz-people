<h3>{{ ucwords($map->company_name) . ', ' . $map->floor }}</h3>

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

		if(is_null($seat->user_id) && is_null($seat->printer_id))
			$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'>";
		else
		{
			if(is_null($seat->user_id) && ! is_null($seat->printer_id))
			{
				$element = "<area class='printer' data-toggle='modal' data-target='#printer_info_modal' shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
				$element .= " title='Printer: {$seat->printer->name}' href='#' onclick='javascript: return false'>";
			}
			else
			{
				$element = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'";
				$element .= " title='{$seat->user->displayname}'";
				$element .= " href='";
				$element .= URL::to("profile/{$seat->user_id}");
				$element .= "'>";
			}
		}

		break;
	}
	echo $element;
}

?>
</map>

<!-- Modal -->
<div class="modal fade" id="printer_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">{PRINTER_NAME}</h4>
			</div>
			<div class="modal-body">
				<p class="printer_name">Name: {NAME}</p>
				<p class="printer_unc_path">UNC Path: {UNC_PATH}</p>
				<button type="button" class="btn btn-default btn-sm">Show Installation Inscructions</button>
			</div>
		</div>
	</div>
</div>

<script>

$("area").qtip({
    position: {
        my: 'top left'
    }
});

</script>