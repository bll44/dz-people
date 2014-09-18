<h3>{{ ucwords($map->company_name) . ', ' . $map->floor }}</h3>

<img src="{{ $image }}" class="map-img" usemap="#seat-map">

<map name="seat-map">
@foreach($map->areas as $area)

{{ $area }}

@endforeach
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