@extends('layouts.master')


@section('content')
<style>

#directory-search {
	margin-top: 22px;
}

</style>

<div class="row">
<div class="col-md-6">
	<h3>Day <span class="brand-color">&amp;</span> Zimmermann, Philadelphia</h3>
</div>
<div class="col-md-offset-2 col-md-4">
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