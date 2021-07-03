<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('assets/img/logo/logo2.png')}}">
    </div>
    <div class="sidebar-brand-text mx-3">RuangAdmin</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Management
  </div>
  <li class="nav-item">
    <a class="nav-link" href="{{route('admin-product')}}">
      <i class="fa fa-archive"></i>
      <span>Produk</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->