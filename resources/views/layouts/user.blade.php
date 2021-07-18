<!DOCTYPE html>
<html lang="en">
@include('templates.user.head')
<body class="home-page home-01 shopping-cart">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				@include('templates.user.topbar-top')

				@include('templates.user.topbar-mid')

				@include('templates.user.topbar-end')
			</div>
		</div>
	</header>

	<main id="main" class="main-site">
		<div class="container">

			@yield('content')

		</div>

	</main>

	@include('templates.user.footer')	
	
	
	@include('templates.user.script')	
</body>
</html>