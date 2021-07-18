<!DOCTYPE html>
<html lang="en">

@include('templates.admin.head')
@yield('page-head')

<body id="page-top">
  <div id="wrapper">
    @include('templates.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        @include('templates.admin.topbar')

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">

          @yield('content')

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Logout Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" type="submit">Logout</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      @include('templates.admin.footer')
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @include('templates.admin.script')
  @yield('page-script')
</body>

</html>