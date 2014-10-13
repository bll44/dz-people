@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col-lg-12"
	<ul class="list-group">
		@foreach($maps as $m)
			{{ link_to_route('coordinator.show', $m->company_name.', '.$m->floor, $m->id, ['class' => 'list-group-item']) }}
		@endforeach
	</ul>
	</div>
	<!-- /.column -->
	<!-- /.list-group -->
</div>
<!-- /.row -->

@stop