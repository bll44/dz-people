<div class="row">

	@foreach($maps as $map)

		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<div class="thumbnail">
				{{ HTML::image($map->image) }}
				<div class="caption">
					<h3>Floor {{ $map->floor }}</h3>
					<p>{{ $map->description }}</p>
					<p>
						{{ link_to("seat/{$objGuid}/{$map->id}/edit", 'Select', ['role' => 'button', 'class' => 'btn btn-success']) }}
					</p><!-- / caption text -->
				</div><!-- /.caption -->
			</div><!-- /.thumbnail -->
		</div><!-- /.col-sm-6 col-md-4 -->

	@endforeach

</div><!-- /.row -->