  <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="{{ asset('assets/js/ruang-admin.min.js')}}"></script>

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