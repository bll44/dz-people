@extends('layouts.master')


@section('content')

<div class="row">
	
	<?php $i = 0 ?>
	@foreach($maps as $map)

	<?php if($i > 2) break ?>

		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				{{ HTML::image($map->image) }}
				<div class="caption">
					<h3>Floor {{ $map->floor }}</h3>
					<p>{{ $map->description }}</p>
					<p>
						{{ link_to("map/{$map->id}", 'View', ['role' => 'button', 'class' => 'btn btn-success']) }}
					</p><!-- / caption text -->
				</div><!-- /.caption -->
			</div><!-- /.thumbnail -->
		</div><!-- /.col-sm-6 col-md-4 -->
	
	<?php $i++ ?>
	@endforeach

</div><!-- /.row -->

@stop