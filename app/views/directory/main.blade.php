@extends('layouts.master')


@section('content')
<style>

#directory-search {
	margin-top: 22px;
}

</style>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<h3>Day <span class="brand-color">&amp;</span> Zimmermann, Philadelphia</h3>
</div>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-4 col-md-4 col-xs-offset-0 col-sm-offset-0 col-xs-12 col-sm-6">
	{{ Form::open(['url' => 'directory/search', 'method' => 'get']) }}
		<div class="input-group input-group-sm" id="directory-search">
			<input type="text" name="query" class="form-control" placeholder="Search directory..." value="{{ $query or '' }}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default" id="search-btn">Search</button>
			</span>
		</div>
	{{ Form::close() }}
</div>

</div>

<div class="table-responsive">

	<table class="table table-striped table-hover" id="directory-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Company</th>
				<th>Department</th>
			</tr>
		</thead>
		<tbody>

		@foreach($users as $user)

		<tr id="{{ $user->objectguid }}">
			<td>{{ $user->displayname }}</td>
			<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
			<td>{{ $user->phone }}</td>
			<td>{{ $user->company }}</td>
			<td>{{ $user->department }}</td>
		</tr>

		@endforeach

		</tbody>

	</table>

</div>

{{ $users->links() }}

<script>

$('tr').not('tr:first').click(function() {
	var id = $(this).attr('id');
	window.location = "{{ URL::to('profile') }}"+'/'+id;
});
$(document).ready(function() {
	$('tr:first').css('cursor', 'default');
});

</script>

@stop