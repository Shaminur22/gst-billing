<!-- ========== Left Sidebar Start ========== -->
<style>
  .left-side-menu {
    background-color: #475569ff; /* Sidebar background */
    color: #fff; /* Default white text */
  }

  /* All main menu links white */
  .left-side-menu a {
    color: #fff !important;
    text-decoration: none;
  }

  /* Hover and focus - keep white text and add slight background effect */
  .left-side-menu a:hover,
  .left-side-menu a:focus {
    color: #000000 !important;
    background-color: rgba(255,255,255,0.1); /* subtle highlight */
  }

  /* User box text white */
  .left-side-menu .user-box p {
    color: #fff !important;
  }

  /* Arrows and icons white */
  .left-side-menu .menu-arrow,
  .left-side-menu i[data-feather] {
    color: #fff !important;
    stroke: #fff !important;
  }

  /* Submenu links white */
  .left-side-menu .nav-second-level a {
    color: #000000 !important;
  }

  /* Submenu hover white with subtle background */
  .left-side-menu .nav-second-level a:hover {
    color: #000000 !important;
    background-color: rgba(255,255,255,0.15);
  }
</style>

<div class="left-side-menu">
  <div class="h-100" data-simplebar>
    <!-- User box -->
    <div class="user-box text-center">
      <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md" />
      <p class="text-muted mt-2">Admin Head</p>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul id="side-menu">

        <li>
          <a href="{{ route('dashboard') }}">
            <i data-feather="home"></i>
            <span> Dashboard </span>
          </a>
        </li>

        <li>
          <a href="#sidebarEcommerce" data-toggle="collapse">
            <i data-feather="users"></i>
            <span> Customers </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="sidebarEcommerce">
            <ul class="nav-second-level">
              <li>
                <a href="{{route('add-party')}}"><i data-feather="plus" class="pr-0 mr-1"></i>Add New</a>
              </li>
              <li>
                <a href="{{route('manage-parties')}}"><i data-feather="list" class="pr-0 mr-1"></i>Manage Customers</a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a href="#sidebarCrm" data-toggle="collapse">
            <i data-feather="edit"></i>
            <span> GST Billing </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="sidebarCrm">
            <ul class="nav-second-level">
              <li>
                <a href="{{ route('add-gst-bill') }}"><i data-feather="plus" class="pr-0 mr-1"></i>Create bill</a>
              </li>
              <li>
                <a href="{{ route('manage-gst-bills') }}"><i data-feather="list" class="pr-0 mr-1"></i>Manage all bills</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
  </div>
  <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
