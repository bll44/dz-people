@extends('layouts/admin')

@section('content')

<div class="row">
	<div class="col-lg-4 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<p class="panel-title"><i class="fa fa-print fa-fw"></i> All Printers</p>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				@if($printers->count() > 0)
				<ul class="list-group">
					@foreach($printers as $printer)

					<a href="#" class="list-group-item"><i class="fa fa-caret-right fa-fw"></i> {{ $printer->name }}</a>

					@endforeach
				</ul>
				<!-- /.list-group -->
				@else

					<h5>No Printers</h5>

				@endif
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-4 -->

	<div class="col-lg-4 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<p class="panel-title"><i class="fa fa-plus fa-fw"></i> Add Printer</p>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				{{ Form::open(['route' => 'admin.printmgmt.store', 'role' => 'form']) }}

				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Printer name']) }}
				</div>

				<div class="form-group">
					{{ Form::label('path', 'UNC Path') }}
					{{ Form::text('path', null, ['class' => 'form-control', 'placeholder' => 'Printer UNC path']) }}
				</div>

				<div class="form-group">
					{{ Form::label('company', 'Company') }}
					{{ Form::select('company', array(
						'' => ' --- ',
						'dayzim' => 'Day & Zimmermann',
						'yoh' => 'Yoh'
					), null, ['class' => 'form-control', 'id' => 'company_dropdown']) }}
				</div>

				<div class="form-group">
					{{ Form::label('floor', 'Floor', ['class' => 'hidden floor_dropdown']) }}
					{{ Form::select('floor', array(), null, ['class' => 'form-control hidden floor_dropdown', 'placeholder' => 'Floor #']) }}
				</div>

				{{ Form::submit('Add Printer', ['class' => 'btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12']) }}

				{{ Form::close() }}
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->

@stop

@section('scripts')

<script>

$('#company_dropdown').change(function() {
	var value = $(this).val();

	$.ajax({
		url: "{{ URL::to('admin/get_floors') }}",
		type: 'GET',
		data: { company_code: value },
		dataType: 'json'
	}).done(function(data) {
		$('select.floor_dropdown').html('');
		for(var i in data)
		{
			console.log(data[i]);
			$('select.floor_dropdown').append(
				"<option value='" + data[i] + "'>" + data[i] + "</option>"
			);
		}
		$('.floor_dropdown').removeClass('hidden');
	});
});

</script>

@stop