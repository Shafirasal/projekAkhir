<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="app/dist/img/polinema.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIVEY Polinema</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="app/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <p class = "d-block text-white"><b><?= $_SESSION['username'] ?></b></p> 
          </div>
        </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="input.php" class="nav-link">
             <i class="bi bi-pencil-square"></i>
              <p>
                Informasi User
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="bi bi-pencil-square "></i>
              <p>
                Kuisioner
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="akademik_mahasiswa.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Akademik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fasilitas_mahasiswa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fasilitas</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="layanan_mahasiswa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Layanan</p>
                </a>
              </li>
            </ul>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
             <i class="bi bi-box-arrow-right"></i>
              <p>
                Log out
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>