<nav class="navbar navbar-default" role="navigation">
	<div class="container container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			@include('layouts/partials/navs/coordinator-nav-brand')
		</div><!-- /.navbar-header -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>{{ link_to('admin', 'Admin Page') }}</li>
				<li>{{ link_to('directory', 'Main Site') }}</li>
				@include('layouts/partials/navs/admin-apps-dropdown')
			</ul><!-- /.nav navbar-nav (left-nav) -->
		</div><!-- /.collapse navbar-collapse -->
	</div><!-- /.container container-fluid -->
</nav><!-- /.navbar navbar-default -->
<script>
var activePage = "{{ $activePage or '' }}";
if(activePage.length > 0) $('#navtab-' + activePage).addClass('active');
</script>