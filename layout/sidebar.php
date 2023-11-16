<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'] ; ?></a>
        </div>
      </div>

      <?php 
      $hak_akses = isset($_SESSION["hak_akses"]) ? $_SESSION["hak_akses"]  : '';

      function isPageActive($linkURL){
        $currentUrl = $_GET["module"];
        return($currentUrl == $linkURL);
      }

      if ($hak_akses =='Super Admin') { ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="?module=beranda" class="nav-link <?php echo isPageActive('beranda') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
              <li class="nav-item ">
                <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('master') ? 'active' : ''; ?>">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Master HRM
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=dataKaryawan" class="nav-link <?php echo isPageActive('dataItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Karyawan</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=dataLokasi" class="nav-link <?php echo isPageActive('dataItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Lokasi</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=dataUnit" class="nav-link <?php echo isPageActive('dataItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Unit</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=dataUnit" class="nav-link <?php echo isPageActive('dataItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Jabatan</p>
                    </a>
                  </li>
                </ul>
            </li>
          <li class="nav-item">
              <a href="?module=User" class="nav-link <?php echo isPageActive('User') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                  User
              </p>
              </a>
              </li>  
    <?php
      }
    ?>