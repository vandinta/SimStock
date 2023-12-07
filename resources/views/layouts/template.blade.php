<!DOCTYPE html>
<html lang="en">

<!-- Header -->
@include('layouts.header')

<body>
	<div class="wrapper">
		<!-- Navbar Start -->
		@include('layouts.navbar')
		<!-- Navbar End -->

		<!-- Sidebar -->
		@include('layouts.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<!-- Content -->
				@yield('content')
			</div>
			<!-- Footer Start -->
			@include('layouts.footer')
			<!-- Footer End -->
		</div>
		<!-- End Custom template -->
	</div>

	<!-- JavaScript Libraries -->
	@include('layouts.js')
	@yield('content_js')
	<!-- Template Javascript -->
</body>

</html>