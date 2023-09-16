<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <img src="<?php echo base_url('public/assets/img/favicon_custom.png') ?>" width="40px">
        <div class="sidebar-brand-text mx-3">ATK | Humas</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    if (session()->get('role') == 'admin') {
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href=".">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <?php
    }
    ?>
    <?php
    if (session()->get('role') == 'user') {
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="Homeuser">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard User</span></a>
    </li>
    <?php
    }
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if (session()->get('role') == 'admin') {
    ?>
        <li class="nav-item">

            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Admin</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="manajemenuser">Management Akun</a>
                    <div class="collapse-divider"></div>
                </div>
            </div>
        </li>
    <?php
    }
    ?>

    <?php
    if (session()->get('role') == 'admin') {
    ?>
    <!-- Nav Item - Tables -->
    <li class="nav-item active">
        <a class="nav-link" href="barang">
            <i class="fas fa-fw fa-table"></i>
            <span>ATK Humas Admin</span></a>
    </li>
    <?php
    }
    ?>

    <?php
    if (session()->get('role') == 'user') {
    ?>
    <!-- Nav Item - Tables -->
    <li class="nav-item active">
        <a class="nav-link" href="baranguser">
            <i class="fas fa-fw fa-table"></i>
            <span>ATK Humas</span></a>
    </li>
    <?php
    }
    ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->