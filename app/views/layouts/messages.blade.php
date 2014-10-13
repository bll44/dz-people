<!DOCTYPE html>
<html lang="en">

@include('layouts/partials/header')

<body>

@yield('styles')

@include('layouts/partials/navs/master-nav')

	<div class="container">

	<p class="alert alert-success">@yield('message')</p>

	</div>

@include('layouts/partials/footer')

@yield('scripts')

</body>
</html>