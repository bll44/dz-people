<nav class="navbar navbar-default" role="navigation">
	<div class="container container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			@include('layouts/partials/navs/nav-brand')
		</div><!-- /.navbar-header -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li id="navtab-directory">{{ link_to('directory', 'Directory') }}</li>
				<li id="navtab-maps">{{ link_to('map', 'Maps') }}</li>
			</ul><!-- /.nav navbar-nav (left-nav) -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Hi, {{ Session::get('logged_in_user')->firstname }} {{ Session::get('logged_in_user')->lastname }}
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>{{ link_to('profile/'.Session::get('logged_in_user')->objectguid, 'My Profile') }}</li>
					</ul>
				</li>
			</ul><!-- /.nav (right-nav) -->
		</div><!-- /.collapse navbar-collapse -->
	</div><!-- /.container container-fluid -->
</nav><!-- /.navbar navbar-default -->
<script>
var activePage = "{{ $activePage or '' }}";
if(activePage.length > 0) $('#navtab-' + activePage).addClass('active');
</script>