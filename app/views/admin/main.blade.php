@extends('layouts/admin')


@section('content')

<p>{{ link_to('ldap/pull', 'Refresh LDAP data', ['target' => '_blank', 'class' => 'confirm']) }}</p>
<p>{{ link_to('coordinator', 'Seat coordinator application') }}</p>
<p>{{ link_to('admin/userManager', 'User manager') }}</p>
<p>{{ link_to('admin/cms/addMap', 'Add maps') }}</p>

<script>

$('.confirm').click(function(e) {
	if(confirm('Are you sure you want to refresh LDAP data?'))
		return true;
	elsE
		return false;
});

</script>

@stop