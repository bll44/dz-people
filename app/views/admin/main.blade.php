@extends('layouts/admin')


@section('content')

<div id="HUD-wrapper">

	<div class="row">

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-database fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">
								@if(($n = LDAP::daysSinceUpdate()) == 1)
									{{ $n . ' Day' }}
								@else
									{{ $n . ' Days' }}
								@endif
							</div>
							<div>Since Last LDAP Update</div>
						</div>
					</div>
				</div>
				<a href="{{ URL::to('admin/ldap/pull') }}" id="refreshLdap" class="confirm" data-action="refresh LDAP data">
					<div class="panel-footer">
						<span class="pull-left">Refresh LDAP Data</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div><!-- / panel -->

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{ $users }}</div>
							<div>Total Users</div>
						</div>
					</div>
				</div>
				<a href="{{ URL::to('admin/userManager') }}">
					<div class="panel-footer">
						<span class="pull-left">Manage Users</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div><!-- / panel -->

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-globe fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{ $maps }}</div>
							<div>Floor Maps</div>
						</div>
					</div>
				</div>
				<a href="{{ URL::to('admin/content/addMap') }}">
					<div class="panel-footer">
						<span class="pull-left">Add or Manage Locations</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div><!-- / panel -->

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-print fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{ $printers }}</div>
							<div>Printers</div>
						</div>
					</div>
				</div>
				<a href="{{ URL::to('admin/printmgmt') }}">
					<div class="panel-footer">
						<span class="pull-left">Manage Printers</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div><!-- / panel -->

	</div><!-- / row -->

	<div class="row">

		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-crosshairs fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<!-- <div class="huge">0</div> -->
							<div>Seat Coordinator</div>
						</div>
					</div>
				</div>
				<a href="{{ URL::to('coordinator') }}">
					<div class="panel-footer">
						<span class="pull-left">Open Seat Coordinator App</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div><!-- / panel -->

	</div><!-- / row -->

</div><!-- / HUD-wrapper -->

<script>

$('.confirm').click(function(e) {
	var action = $(this).data('action');
	if(confirm('Are you sure you want to perform the following action?\r\n\r\n' + action))
		return true;

	return false;
});

</script>

@stop