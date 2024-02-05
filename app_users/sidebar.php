<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <?php
      if(isset($_SESSION['nama']) && isset($_SESSION['role'])) {
        echo '<a href="#" class="d-block">' . ucwords($_SESSION['nama']) . '<br>' . ucfirst($_SESSION['role']) . '</a>';
      } else {
        echo '<a href="#" class="d-block">Guest</a>'; // Default message if session data is not set
      }
      ?>
    </div>
  </div>

    <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

    <!-- Sidebar Menu -->
    <?php 
    if ($_SESSION['role'] == 'admin') {
      include('menu/admin.php');
    } else if ($_SESSION['role'] == 'pimpinan') {
      include('menu/pimpinan.php');
    } else {
      include('menu/user.php');
    }
  
    ?>
  <!-- /.sidebar-menu -->
</div>