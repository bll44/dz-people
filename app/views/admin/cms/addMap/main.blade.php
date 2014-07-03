@extends('layouts/admin')


@section('content')
<div class="row">

	{{ Form::open(['url' => 'admin/cms/upload/map', 'files' => true, 'role' => 'form']) }}

		<div class="form-group col-md-8">
			{{ Form::label('company', 'Company') }}
			{{ Form::select('company', ['dayzim' => 'Day & Zimmermann', 'yoh' => 'Yoh'], null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group col-md-8">
			{{ Form::label('address', 'Address') }}
			{{ Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Address (e.g. 1500 Spring Garden Street)']) }}
		</div>
		<div class="form-group col-md-6" style="display: inline">
			{{ Form::label('city', 'City') }}
			{{ Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'City (e.g. Philadelphia)']) }}
		</div>
		<div class="form-group col-md-2" style="display: inline">
			{{ Form::label('zip', 'Zip Code') }}
			{{ Form::text('zip', '', ['class' => 'form-control', 'placeholder' => '12345']) }}
		</div>
		<div class="form-group col-md-8">
			{{ Form::label('description', 'Map Description') }}
			{{ Form::textarea(
				'description', '', ['class' => 'form-control', 'placeholder' => 'Description of map...', 'rows' => '4']
			) }}
		</div>
		<div class="form-group col-md-8">
			{{ Form::label('map_image', 'Map Image') }}
			{{ Form::file('map_image') }}
			<p>Upload Map image file. File type must be `.jpeg` or `.jpg`</p>
		</div>
		<div class="form-group col-md-8">
			<button type="submit" class="btn btn-success">Upload Map</button>
		</div>

	{{ Form::close() }}

</div><!-- /.row -->

<div class="row">

	<div class="col-md-8">

		<input class="form-control" disabled="true" placeholder="No image">

	</div>

</div><!-- /.row -->

@stop