@extends('layouts/admin')


@section('content')
<div class="row">
	<div class="col-md-6">
		<h3>Site Administrators</h3>
	</div>
	<div class="col-md-offset-2 col-md-4">
		{{ Form::open(['url' => 'admin/userManager', 'method' => 'get', 'style' => 'margin-top: 18px']) }}
			<div class="input-group input-group-sm" id="directory-search">
				<input type="text" name="query" class="form-control" placeholder="Search users..." value="{{ $query or '' }}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default" id="search-btn">Search</button>
				</span>
			</div>
		{{ Form::close() }}
	</div>
</div>
<table class="table">
<thead>
<tr>
	<th>Name</th>
	<th>Admin</th>
	<th>Title</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)

<tr data-user="{{ $user->objectguid }}">
	<td>{{ $user->displayname }}</td>
	<td>
		<div class="btn-group" data-toggle="buttons">
		@if($user->admin)
			<label class="btn btn-sm btn-info active">
				<input type="radio" name="status" id="status-yes" value="yes"> Yes
			</label>
			<label class="btn btn-sm btn-info">
				<input type="radio" name="status" id="status-no" value="no"> No
			</label>
		@else
			<label class="btn btn-sm btn-info">
				<input type="radio" name="status" id="status-yes" value="yes"> Yes
			</label>
			<label class="btn btn-sm btn-info active">
				<input type="radio" name="status" id="status-no" value="no"> No
			</label>
		@endif
		</div>
	</td>
	<td>{{ $user->title }}</td>
</tr>

@endforeach
</tbody>
</table>

{{ $users->links() }}

<script>

$('input[name="status"]').change(function() {

	var status = $(this).val();
	var user = $(this).closest('tr').data('user');

	$.get("{{URL::to('admin/adminChange')}}", { user: user, status: status }, null, 'json')
	.done(function(data) {
		console.log(data);
	});
});

</script>
@stop