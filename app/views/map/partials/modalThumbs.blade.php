@foreach($allMaps as $m) <!-- loop through all Map objects -->

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
				@elseif($viewMode === 'printmgmt')
				{{ link_to("admin/printmgmt/seatPrinter/{$printer->id}/{$m->id}", 'View', ['role' => 'button', 'class' => 'btn btn-success']) }}
				@endif
			</p>
		</div>
		<!-- /.caption -->
	</div>
	<!-- /.thumbnail -->
</div>
<!-- /.column -->

@endforeach