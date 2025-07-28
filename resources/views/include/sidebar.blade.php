<!-- ========== Left Sidebar Start ========== -->
<style>
  .left-side-menu {
    background: linear-gradient(90deg, #00eaff 0%, #009dff 100%);
    color: #fff;
  }

  /* Main menu links */
  .left-side-menu a {
    color: #fff !important;
    text-decoration: none;
    position: relative;
    display: flex;
    align-items: center;
    transition: color 0.3s;
  }

  /* Underline flash animation */
  .left-side-menu a::after {
    content: '';
    position: absolute;
    bottom: 6px; /* adjust to align under text */
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #fff, #fff);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease-in-out;
    border-radius: 2px;
  }

  .left-side-menu a:hover::after,
  .left-side-menu a:focus::after {
    transform: scaleX(1);
  }

  /* Right arrow icon after text on hover */
  .left-side-menu a .hover-arrow {
    margin-left: 8px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    font-weight: bold;
    color: #fff; /* bright accent color */
    user-select: none;
  }

  .left-side-menu a:hover .hover-arrow,
  .left-side-menu a:focus .hover-arrow {
    opacity: 1;
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

  /* Submenu links */
  .left-side-menu .nav-second-level a {
    color: #fff !important;
    position: relative;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: color 0.3s;
  }

  /* Submenu underline flash */
  .left-side-menu .nav-second-level a::after {
    content: '';
    position: absolute;
    bottom: 6px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #fff, #fff);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease-in-out;
    border-radius: 2px;
  }

  .left-side-menu .nav-second-level a:hover::after,
  .left-side-menu .nav-second-level a:focus::after {
    transform: scaleX(1);
  }

  /* Submenu right arrow on hover */
  .left-side-menu .nav-second-level a .hover-arrow {
    margin-left: 8px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    font-weight: bold;
    color: #fff;
    user-select: none;
  }

  .left-side-menu .nav-second-level a:hover .hover-arrow,
  .left-side-menu .nav-second-level a:focus .hover-arrow {
    opacity: 1;
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
          <a href="{{ route('dashboard') }}" title="Dashboard">
            <i data-feather="home"></i>
            <span>Dashboard</span>
            <span class="hover-arrow">→</span>
          </a>
        </li>

        <li>
          <a href="#sidebarEcommerce" data-toggle="collapse" title="Customers">
            <i data-feather="users"></i>
            <span>Customers</span>
            <span class="menu-arrow"></span>
            <span class="hover-arrow">→</span>
          </a>
          <div class="collapse" id="sidebarEcommerce">
            <ul class="nav-second-level">
              <li>
                <a href="{{route('add-party')}}" title="Add New Customer">
                  <i data-feather="plus" class="pr-0 mr-1"></i>
                  Add New
                  <span class="hover-arrow">→</span>
                </a>
              </li>
              <li>
                <a href="{{route('manage-parties')}}" title="Manage Customers">
                  <i data-feather="list" class="pr-0 mr-1"></i>
                  Manage Customers
                  <span class="hover-arrow">→</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li>
          <a href="#sidebarCrm" data-toggle="collapse" title="GST Billing">
            <i data-feather="edit"></i>
            <span> Billing</span>
            <span class="menu-arrow"></span>
            <span class="hover-arrow">→</span>
          </a>
          <div class="collapse" id="sidebarCrm">
            <ul class="nav-second-level">
              <li>
                <a href="{{ route('add-gst-bill') }}" title="Create Bill">
                  <i data-feather="plus" class="pr-0 mr-1"></i>
                  Create bill
                  <span class="hover-arrow">→</span>
                </a>
              </li>
              <li>
                <a href="{{ route('manage-gst-bills') }}" title="Manage All Bills">
                  <i data-feather="list" class="pr-0 mr-1"></i>
                  Manage all bills
                  <span class="hover-arrow">→</span>
                </a>
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
