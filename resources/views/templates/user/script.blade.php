    <script src="{{ asset('user-assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset('user-assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset('user-assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('user-assets/js/jquery.flexslider.js')}}"></script>
	<script src="{{ asset('user-assets/js/chosen.jquery.min.js')}}"></script>
	<script src="{{ asset('user-assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset('user-assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{ asset('user-assets/js/jquery.sticky.js')}}"></script>
	<script src="{{ asset('user-assets/js/functions.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script>
	@if(Session::has('success'))
		toastr.success("{{ session('success') }}");
	@endif
	
	@if(Session::has('error'))
		toastr.error("{{ session('error') }}");
	@endif
	
	@if(Session::has('info'))
		toastr.info("{{ session('info') }}");
	@endif
	
	@if(Session::has('warning'))
		toastr.warning("{{ session('warning') }}");
	@endif
	</script>