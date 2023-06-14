<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span><i class="fas fa-solid fa-user mr-2"></i><?= $this->session->userdata('nama_pengguna') ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                
                <!-- <div class="dropdown-divider"></div> -->
                <a href="#" class="dropdown-item">
                    My Profile
                </a>
                <!-- <div class="dropdown-divider"></div> -->
                <a href="<?= base_url('Autentikasi/keluar') ?>" class="dropdown-item">
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->