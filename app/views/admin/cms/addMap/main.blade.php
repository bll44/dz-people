@extends('layouts/admin')


@section('content')
<div>
	<h3>Add a New Map</h3>
</div>
<div>
	<small><i>* All fields are required</i></small>
</div>
	{{ Form::open(['url' => 'admin/cms/upload/map', 'files' => true, 'role' => 'form', 'id' => 'new-map-form']) }}
		{{ Form::hidden('image', '', ['id' => 'image']) }}
		<div class="row">
			<div class="form-group col-md-8">
				{{ Form::label('company', 'Company') }}
				{{ Form::select(
					'company',
					['dayzim' => 'Day & Zimmermann', 'yoh' => 'Yoh'],
					null,
					['class' => 'form-control', 'id' => 'company']
				) }}
			</div>
		</div><!-- /.row -->
		<div class="row">
			<div class="form-group col-md-8">
				{{ Form::label('address', 'Address') }}
				{{ Form::text(
					'address',
					'',
					['class' => 'form-control', 'placeholder' => 'Address (e.g. 1500 Spring Garden Street)']
				) }}
			</div>
		</div><!-- /.row -->
		<div class="row">
			<div class="form-group col-md-5">
				{{ Form::label('city', 'City') }}
				{{ Form::text(
					'city', '', ['class' => 'form-control', 'placeholder' => 'City (e.g. Philadelphia)', 'id' => 'city']
				) }}
			</div>
			<div class="form-group col-md-2">
				{{ Form::label('zip', 'Zip Code') }}
				{{ Form::text('zip', '', ['class' => 'form-control', 'placeholder' => '12345']) }}
			</div>
			<div class="form-group col-md-1">
				{{ Form::label('floor', 'Floor') }}
				{{ Form::text('floor', '', ['class' => 'form-control', 'placeholder' => '#', 'id' => 'floor']) }}
			</div>
		</div><!-- /.row -->

		<div class="row">
			<div class="form-group col-md-8">
				{{ Form::label('description', 'Map Description') }}
				{{ Form::textarea(
					'description', '', ['class' => 'form-control', 'placeholder' => 'Description of map...', 'rows' => '4']
				) }}
			</div>
		</div><!-- /.row -->
		<div class="row">
			<div class="form-group col-md-8">
				{{ Form::label('map_image', 'Map Image') }}
				{{ Form::file('map_image', ['id' => 'file']) }}
				<p>Upload Map image file. File type must be `.jpeg` or `.jpg`</p>
			</div>
		</div><!-- /.row -->
		<div class="row">
			<div class="form-group col-md-2">
				<button type="submit" class="btn btn-success">Upload Map</button>
			</div>
			<div class="form-group col-md-6">
				<input class="form-control" id="input-path-preview" disabled="true" placeholder="No image" value="images/maps/">
			</div>
		</div><!-- /.row -->

	{{ Form::close() }}

</div><!-- /.row -->

<div class="row">

	<div class="col-md-8" style="margin-bottom: 15px">

		<!-- <input class="form-control" id="input-path-preview" disabled="true" placeholder="No image" value="images/maps/"> -->

	</div>

</div><!-- /.row -->

<script>
var path = {};
path.segments = { images: 'images', maps: 'maps', company: null, city: null, file: null };
path.element = $('#input-path-preview');
path.createPathString = function() {
	this.pathString = '';
	for(var x in this.segments)
	{
		if(this.segments[x] === null) break;

		this.pathString += this.segments[x] + '/';
	}
	this.pathString = this.pathString.substring(0, this.pathString.length - 1);
};
path.outputPreview = function() {
	this.createPathString();
	this.element.val(this.pathString);
};
$('#file').change(function() {

	var splitPath = $(this).val().split('\\'),
		fileName = splitPath[splitPath.length - 1],
		pos = fileName.lastIndexOf('.'),
		fileExt = fileName.substring(pos + 1);

	if(fileExt !== 'jpg' && fileExt !== 'jpeg')
	{
		alert('File type must be `.jpeg` or `.jpg`. Please choose a different file.');
		$(this).val('');
		return false;
	}

	if((floor = $('#floor').val()) > 0)
	{
		path.segments.file = 'floor-' + floor + '.' + fileExt;
		path.outputPreview();
	}
});

$(document).ready(function() {
	path.segments.company = $('#company').val();
	path.outputPreview();
});

$('#new-map-form select').change(function() {
	path.segments[$(this).attr('id')] = $(this).val();
	path.outputPreview();
});

$('#city').bind('focusout', function(e) {
	path.segments.city = $(this).val().toLowerCase();
	path.outputPreview();
});

$('#new-map-form').submit(function(e) {
	$('#image').val(path.pathString);
	return true;
});
</script>

@stop