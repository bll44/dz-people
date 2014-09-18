<!DOCTYPE html>
<html lang="en">

@include('layouts/partials/admin_header')

<body>
@include('layouts/partials/navs/admin-nav')

	<div class="container">

		@yield('content')

	</div>

	@yield('scripts')

@include('layouts/partials/admin_footer')
</body>
</html>