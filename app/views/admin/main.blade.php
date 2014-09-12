@extends('layouts/admin')


@section('content')

<div class="row">

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ LDAP::daysSinceUpdate() }} Days</div>
						<div>Since Last LDAP Update</div>
					</div>
				</div>
			</div>
			<a href="{{ URL::to('admin/ldap/pull') }}">
				<div class="panel-footer">
					<span class="pull-left">Refresh LDAP Data</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div><!-- / panel -->

</div><!-- / row -->

<p>{{ link_to('coordinator', 'Seat coordinator application') }}</p>
<p>{{ link_to('admin/userManager', 'User manager') }}</p>
<p>{{ link_to('admin/content/addMap', 'Add maps') }}</p>
<p>{{ link_to('printers/place', 'Manage Printers') }}</p>

<script>

$('.confirm').click(function(e) {
	if(confirm('Are you sure you want to refresh LDAP data?'))
		return true;
	elsE
		return false;
});

</script>

@stop